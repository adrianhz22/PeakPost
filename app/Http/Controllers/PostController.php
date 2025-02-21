<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
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

    public function store(Request $request)
    {

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $request->image,
        ]);

        return redirect('home');

    }

    public function edit(Post $post)
    {

        return view('edit', compact('post'));

    }

    public function update(Request $request, Post $post)
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
        $post->delete();

        return redirect('home');

    }

    public function uploadImage(Request $request)
    {

        $path = $request->file('file')->store('posts', 'public');

        return response()->json(['path' => "/storage/$path"]);
    }


}
