<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    use AuthorizesRequests;
    public function store(CommentRequest $request, Post $post)
    {
        $user = Auth::user();

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => $request->input('content'),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Nuevo comentario',
            'description' => "El usuario {$user->name} ha comentado en un post."
        ]);

        return redirect()->route('posts.show', $post);

    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $user = Auth::user();

        $this->authorize('update', $comment);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Comentario editado',
            'description' => "El usuario {$user->name} ha editado un comentario."
        ]);

        return redirect()->back();

    }

    public function destroy(Comment $comment) {

        $user = Auth::user();

        $this->authorize('delete', $comment);

        $comment->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Comentario eliminado',
            'description' => "El usuario {$user->name} ha eliminado un comentario."
        ]);

        return redirect()->back();

    }
}
