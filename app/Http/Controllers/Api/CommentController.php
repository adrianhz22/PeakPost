<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'post'])->get();
        return response()->json($comments, 200);
    }

    public function show($id)
    {
        $comment = Comment::with(['user', 'post', 'replies.user'])->findOrFail($id);
        return response()->json($comment);
    }
}
