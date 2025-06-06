<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\SendNewPostEmail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {

        $provinces = config('lists.provinces');
        $difficulties = config('lists.difficulties');

        $query = $request->get('query');
        $province = $request->get('province');
        $difficulty = $request->get('difficulty');
        $sort = $request->get('sort', 'desc');

        $posts = Post::search($query, $sort, $province, $difficulty)->paginate(12);

        return view('home', compact('posts', 'query', 'sort', 'province', 'difficulty', 'provinces', 'difficulties'));
    }

    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    public function create()
    {

        $provinces = config('lists.provinces');
        $difficulties = config('lists.difficulties');

        return view('posts.create', compact('provinces', 'difficulties'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $this->preparePostData($request);
        $post = Post::create($data);

        dispatch_sync(new SendNewPostEmail($post, auth()->user()->email));
        PostCreated::dispatch($post);

        return redirect('home')->with('success', 'Tu post se ha enviado correctamente y está siendo revisado, para ver su estado consulta tus posts.');
    }

    public function edit(Post $post)
    {

        $provinces = config('lists.provinces');
        $difficulties = config('lists.difficulties');

        $this->authorize('update', $post);

        return view('posts.edit', compact('post', 'provinces', 'difficulties'));

    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $this->preparePostData($request, $post);
        $post->fill($data)->save();

        return redirect('home')->with('success', 'Tu post se ha actualizado correctamente y está pendiente de revisión.');
    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);

        $post->delete();

        return redirect('home');

    }

    public function userPosts()
    {

        $user = Auth::user();
        $posts = $user->posts;

        return view('posts.user-posts', compact('posts'));

    }

    public function userLikedPosts()
    {

        $user = Auth::user();
        $likedPosts = $user->likedPosts()->paginate(12);

        return view('posts.my-likes', compact('likedPosts'));

    }

    public function uploadTrixImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048',
        ]);

        $path = $request->file('file')->store('trix-images', 'public');

        return response()->json([
            'url' => Storage::url($path)
        ]);
    }

    private function preparePostData($request, $post = null)
    {
        $data = $request->validated();

        $data['image'] = $post ? $post->image : null;
        $data['track'] = $post ? $post->track : null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('track')) {
            $data['track'] = $request->file('track')->store('posts/tracks', 'public');
        }

        $hours = (int)$request->input('duration_hours', 0);
        $minutes = (int)$request->input('duration_minutes', 0);
        $data['duration'] = ($hours * 60) + $minutes;

        $data['slug'] = Str::slug($data['title']);
        $data['status'] = 'pending';

        if (!$post) {
            $data['user_id'] = auth()->id();
        }

        if ($post) {
            $data['rejection_reason'] = null;
        }

        return $data;
    }

}
