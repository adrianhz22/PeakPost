<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

        $posts = Post::all();

        return view('home', compact('posts'));
    }

    public function show(Post $post)
    {

        return view('show', compact('post'));
    }

    public function create()
    {

        return view('create');
    }

    public function store(PostRequest $request)
    {

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $request->image,
            'user_id' => auth()->id(),
        ]);

        return redirect('home');

    }

    public function edit(Post $post)
    {

        $this->authorize('update', $post);
        return view('edit', compact('post'));

    }

    public function update(PostRequest $request, Post $post)
    {

        $post->title = $request->title;
        $post->slug = Str::slug($post->title);
        $post->body = $request->body;
        $post->image = $request->image;
        $post->save();

        return redirect('home');

    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();
        return redirect('home');

    }

    public function uploadImage(Request $request)
    {

        $path = $request->file('file')->store('posts', 'public');

        return response()->json(['path' => "/storage/$path"]);
    }

    public function userPosts()
    {

        $user = Auth::user();
        $posts = $user->posts;

        return view('user-posts', compact('posts'));

    }

    public function downloadPDF($id)
    {
        $post = Post::findOrFail($id);

        $pdf = Pdf::loadView('pdf', compact('post'));

        return $pdf->download('post_' . $post->id . '.pdf');
    }
}
