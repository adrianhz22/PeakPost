<?php

namespace App\Listeners;

use App\Events\PostLiked;

class UserLikeCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostLiked $event): void
    {
        $user = $event->post->user;

        $totalLikes = $user->posts()->withCount('likes')->get()->sum('likes_count');

        $user->total_likes = $totalLikes;
        $user->save();
    }
}
