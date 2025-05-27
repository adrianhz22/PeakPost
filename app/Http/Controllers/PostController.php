<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\PostRequest;
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

    public function store(Request $request)
    {

        $request->validate(PostRequest::creationRules());

        $imagePath = null;
        $trackPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('track')) {
            $trackPath = $request->file('track')->store('posts/tracks', 'public');
        }

        $hours = (int) $request->input('duration_hours', 0);
        $minutes = (int) $request->input('duration_minutes', 0);
        $totalDuration = ($hours * 60) + $minutes;

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $imagePath,
            'user_id' => auth()->id(),
            'status' => 'pending',
            'province' => $request->province,
            'difficulty' => $request->difficulty,
            'longitude' => $request->longitude,
            'altitude' => $request->altitude,
            'duration' => $totalDuration,
            'track' => $trackPath,
        ]);

        dispatch(new SendNewPostEmail($post, auth()->user()->email));
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

    public function update(Request $request, Post $post)
    {

        $request->validate(PostRequest::updateRules());

        $imagePath = $post->image;
        $trackPath = $post->track;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts/images', 'public');
        }

        if ($request->hasFile('track')) {
            $trackPath = $request->file('track')->store('posts/tracks', 'public');
        }

        $hours = (int) $request->input('duration_hours', 0);
        $minutes = (int) $request->input('duration_minutes', 0);
        $totalDuration = ($hours * 60) + $minutes;

        $post->fill([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $imagePath,
            'province' => $request->province,
            'difficulty' => $request->difficulty,
            'longitude' => $request->longitude,
            'altitude' => $request->altitude,
            'duration' => $totalDuration,
            'track' => $trackPath,
            'status' => 'pending',
            'rejection_reason' => null,
        ])->save();

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

}
