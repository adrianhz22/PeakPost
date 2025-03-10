<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    use AuthorizesRequests;
    public function store(CommentRequest $request, Post $post)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', $post);

    }

    public function destroy(Comment $comment) {

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back();

    }
}
