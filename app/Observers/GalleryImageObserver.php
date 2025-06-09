<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryImageObserver
{

    public function created(GalleryImage $image)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Imagen subida',
            'description' => "El usuario " . Auth::user()->username . " ha subido una nueva imagen."
        ]);
    }

    public function deleted(GalleryImage $image)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Imagen eliminada',
            'description' => "El usuario " . Auth::user()->username . " ha eliminado una imagen."
        ]);

        if ($image->path && Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
    }
}
