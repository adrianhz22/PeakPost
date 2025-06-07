<?php

namespace App\Http\Controllers\Moderation;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageModerationController extends Controller
{
    public function pendingImages()
    {
        $images = GalleryImage::pending()->latest()->paginate(12);

        return view('moderation.pending-images', compact('images'));
    }

    public function approveImage(GalleryImage $image)
    {
        $image->update(['status' => 'approved']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Imagen aprobada',
            'description' => "El usuario " . Auth::user()->username . " ha aprobado una imagen."
        ]);

        return redirect()->route('moderation.pending-images');
    }

    public function rejectImage(GalleryImage $image, Request $request)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $image->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Imagen rechazada',
            'description' => "El usuario " . Auth::user()->username . " ha rechazado una imagen."
        ]);

        return redirect()->route('moderation.pending-images');
    }
}
