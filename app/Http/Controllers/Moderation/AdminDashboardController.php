<?php

namespace App\Http\Controllers\Moderation;

use App\Http\Controllers\Controller;
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

}
