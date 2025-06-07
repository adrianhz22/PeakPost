<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Auth;

class GalleryImageController extends Controller
{

    public function index()
    {
        $images = GalleryImage::where('status', 'approved')->latest()->paginate(20);
        return view('gallery.index', compact('images'));
    }

    public function store(ImageRequest $request)
    {

        $userId = auth()->user()->id;

        $imagePath = $request->file('image')->store('images', 'public');

        GalleryImage::create([
            'path' => $imagePath,
            'title' => $request->title,
            'status' => 'pending',
            'user_id' => $userId,
        ]);

        return redirect()->route('gallery.index');
    }

    public function destroy(GalleryImage $image)
    {
        $image->delete();

        return redirect()->route('gallery.user-images');
    }

    public function userImages()
    {

        $user = Auth::user();
        $images = $user->galleryImages()->latest()->paginate(20);

        return view('gallery.user-images', compact('images'));

    }

}
