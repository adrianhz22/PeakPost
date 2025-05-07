<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $pendingPosts = Post::where('status', 'pending')->count();
        $approvedPosts = Post::where('status', 'approved')->count();
        $rejectedPosts = Post::where('status', 'rejected')->count();
        $totalUsers = User::count();

        $chartData = [
            'labels' => ['Aprobados', 'Pendientes', 'Rechazados'],
            'data' => [$approvedPosts, $pendingPosts, $rejectedPosts],
        ];

        return view('admin.dashboard', compact('totalPosts', 'pendingPosts', 'approvedPosts', 'rejectedPosts', 'totalUsers', 'chartData'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function approvedPosts()
    {
        $posts = Post::where('status', 'approved')->get();
        return view('admin.approvedPosts', compact('posts'));
    }

    public function posts()
    {
        $posts = Post::where('status', 'pending')->get();
        return view('moderation.pending-posts', compact('posts'));
    }
}
