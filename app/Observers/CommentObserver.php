<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    public function created(Comment $comment)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Nuevo comentario',
            'description' => "El usuario " . Auth::user()->username . " ha comentado en un post."
        ]);
    }

    public function updated(Comment $comment)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Comentario editado',
            'description' => "El usuario " . Auth::user()->username . " ha editado un comentario."
        ]);
    }

    public function deleted(Comment $comment)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Comentario eliminado',
            'description' => "El usuario " . Auth::user()->username . " ha eliminado un comentario."
        ]);
    }
}
