<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    public function created(Post $post)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Nuevo post creado',
            'description' => "El usuario " . Auth::user()->username . " ha creado un nuevo post."
        ]);
    }

    public function updated(Post $post)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Post actualizado',
            'description' => "El usuario " . Auth::user()->username . " ha actualizado un post."
        ]);
    }

    public function deleted(Post $post)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Post eliminado',
            'description' => "El usuario " . Auth::user()->username . " ha eliminado un post."
        ]);


        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        if ($post->track && Storage::disk('public')->exists($post->track)) {
            Storage::disk('public')->delete($post->track);
        }
    }
}
