<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->route('show', $post);

    }
}
