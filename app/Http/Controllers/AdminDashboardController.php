<?php

namespace App\Http\Controllers;

use App\Jobs\SendApprovedPostEmail;
use App\Jobs\SendRejectedPostEmail;
use App\Models\ActivityLog;
use App\Models\GalleryImage;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

    public function showPendingPosts()
    {

        Artisan::call('posts:pending');
        $pendingCount = trim(Artisan::output());

        $posts = Post::where('status', 'pending')->paginate(10);

        return view('moderation.pending-posts', compact('posts', 'pendingCount'));

    }

    public function showPendingPost(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function approve(Post $post)
    {

        $post->update(['status' => 'approved']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Post aprobado',
            'description' => "El usuario " . Auth::user()->username . " ha aprobado un post."
        ]);

        dispatch(new SendApprovedPostEmail($post, $post->user));

        return redirect()->route('moderation.pending-posts');
    }

    public function reject(Post $post, Request $request)
    {

        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $post->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Post rechazado',
            'description' => "El usuario " . Auth::user()->username . " ha rechazado un post."
        ]);

        dispatch(new SendRejectedPostEmail($post, $post->user));

        return redirect()->route('moderation.pending-posts');
    }

    public function approvedPosts()
    {
        $posts = Post::approved()->get();
        return view('admin.approvedPosts', compact('posts'));
    }

    public function posts()
    {
        $posts = Post::pending()->get();
        return view('moderation.pending-posts', compact('posts'));
    }

    public function pendingImages()
    {
        $images = GalleryImage::pending()->latest()->paginate(12);

        return view('moderation.pending-images', compact('images'));
    }

    public function approveImage(GalleryImage $image)
    {
        $image->update(['status' => 'approved']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Imagen aprobada',
            'description' => "El usuario " . Auth::user()->username . " ha aprobado una imagen."
        ]);

        return redirect()->route('moderation.pending-images');
    }

    public function rejectImage(GalleryImage $image, Request $request)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $image->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Imagen rechazada',
            'description' => "El usuario " . Auth::user()->username . " ha rechazado una imagen."
        ]);

        return redirect()->route('moderation.pending-images');
    }

}
