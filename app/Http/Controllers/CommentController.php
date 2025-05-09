<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{

    use AuthorizesRequests;
    public function store(CommentRequest $request, Post $post)
    {

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'parent_id' => $request->input('parent_id'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', $post);

    }

    public function update(CommentRequest $request, Comment $comment)
    {

        $this->authorize('update', $comment);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->back();

    }

    public function destroy(Comment $comment) {

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->back();

    }
}
