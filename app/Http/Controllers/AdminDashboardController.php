<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function approvedPosts()
    {
        $posts = Post::where('is_approved', true)->get();
        return view('admin.approvedPosts', compact('posts'));
    }

    public function posts()
    {
        $posts = Post::where('is_approved', false)->get();
        return view('moderation.pending-posts', compact('posts'));
    }
}
