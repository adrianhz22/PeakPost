<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\Achievement;

class AssignAchievement
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
    public function handle(PostCreated $event): void
    {
        $user = $event->post->user;
        $postCount = $user->posts()->count();

        $achievements = [
            5 => 'Bronce',
            20 => 'Plata',
            50 => 'Oro',
        ];

        foreach ($achievements as $numberPosts => $nameAchievement) {

            if ($postCount >= $numberPosts) {
                $achievement = Achievement::where('name', $nameAchievement)->first();

                if (!$user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                    $user->achievements()->attach($achievement->id, [
                        'achieved_at' => now(),
                    ]);
                }
            }
        }
    }
}
