<?php

namespace App\Http\Controllers\Moderation;

use App\Http\Controllers\Controller;
use App\Jobs\SendApprovedPostEmail;
use App\Jobs\SendRejectedPostEmail;
use App\Models\ActivityLog;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class PostModerationController extends Controller
{
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

    public function posts()
    {
        $posts = Post::pending()->get();
        return view('moderation.pending-posts', compact('posts'));
    }

    public function approvedPosts()
    {
        $posts = Post::approved()->get();
        return view('admin.approvedPosts', compact('posts'));
    }
}
