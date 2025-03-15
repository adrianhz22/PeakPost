<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Mail\NuevoPostMailable;
use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {

        $posts = Post::where('is_approved', true)->get();

        return view('home', compact('posts'));
    }

    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    public function create()
    {

        $provinces = [
            'Álava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Ávila', 'Badajoz', 'Barcelona', 'Burgos', 'Cáceres', 'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'Cuenca', 'Gerona', 'Granada', 'Guadalajara', 'Gipuzkoa', 'Huelva', 'Huesca', 'Islas Baleares', 'Jaén', 'La Coruña', 'La Rioja', 'Las Palmas', 'León', 'Lleida', 'Madrid', 'Málaga', 'Murcia', 'Navarra', 'Ourense', 'Palencia', 'Pontevedra', 'Salamanca', 'Segovia', 'Sevilla', 'Soria', 'Tarragona', 'Teruel', 'Toledo', 'Valencia', 'Valladolid', 'Vizcaya', 'Zamora', 'Zaragoza'
        ];

        $difficulties = ['Facil', 'Moderado', 'Dificil'];

        return view('posts.create', compact('provinces', 'difficulties'));
    }

    public function store(PostRequest $request)
    {

        $trackPath = null;

        if ($request->hasFile('track')) {
            $trackPath = $request->file('track')->store('tracks', 'public');
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body,
            'image' => $request->image,
            'user_id' => auth()->id(),
            'is_approved' => false,
            'province' => $request->province,
            'difficulty' => $request->difficulty,
            'longitude' => $request->longitude,
            'altitude' => $request->altitude,
            'time' => $request->time,
            'track' => $trackPath,
        ]);

        Mail::to(auth()->user())->send(new NuevoPostMailable($post));

        return redirect('home')->with('success', 'Tu post se ha enviado correctamente y está siendo revisado, para ver su estado consulta tus posts.');;

    }

    public function edit(Post $post)
    {

        $provinces = [
            'Álava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Ávila', 'Badajoz', 'Barcelona', 'Burgos', 'Cáceres', 'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'Cuenca', 'Gerona', 'Granada', 'Guadalajara', 'Gipuzkoa', 'Huelva', 'Huesca', 'Islas Baleares', 'Jaén', 'La Coruña', 'La Rioja', 'Las Palmas', 'León', 'Lleida', 'Madrid', 'Málaga', 'Murcia', 'Navarra', 'Ourense', 'Palencia', 'Pontevedra', 'Salamanca', 'Segovia', 'Sevilla', 'Soria', 'Tarragona', 'Teruel', 'Toledo', 'Valencia', 'Valladolid', 'Vizcaya', 'Zamora', 'Zaragoza'
        ];

        $difficulties = ['Facil', 'Moderado', 'Dificil'];

        $this->authorize('update', $post);
        return view('posts.edit', compact('post', 'provinces', 'difficulties'));

    }

    public function update(PostRequest $request, Post $post)
    {

        $trackPath = $post->track;

        if ($request->hasFile('track')) {
            $trackPath = $request->file('track')->store('tracks', 'public');
        }

        $post->title = $request->title;
        $post->slug = Str::slug($post->title);
        $post->body = $request->body;
        $post->image = $request->image;
        $post->province = $request->province;
        $post->difficulty = $request->difficulty;
        $post->longitude = $request->longitude;
        $post->altitude = $request->altitude;
        $post->time = $request->time;
        $post->track = $trackPath;
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

        return view('posts.user-posts', compact('posts'));

    }

    public function downloadPDF($id)
    {
        $post = Post::findOrFail($id);

        $pdf = Pdf::loadView('pdfs.post', compact('post'));

        return $pdf->download('post_' . $post->id . '.pdf');
    }

    public function showPendingPosts()
    {
        if (auth()->user()->hasRole('moderator')) {

            $posts = Post::where('is_approved', false)->get();

            return view('moderation.pending-posts', compact('posts'));
        }
    }

    public function showPendingPost(Post $post)
    {
        return view('moderation.pending-show', compact('post'));
    }

    public function approve(Post $post)
    {
        $post->update(['is_approved' => true]);

        return redirect()->route('moderation.pending-posts');
    }

    public function reject(Post $post)
    {
        $post->delete();

        return redirect()->route('moderation.pending-posts');
    }

}
