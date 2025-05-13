<?php

use App\Events\PostCreated;
use App\Models\Achievement;
use App\Models\Post;
use App\Models\User;

it('assigns the correct achievement', function () {

    $user = User::factory()->create();

    Achievement::create([
        'name' => 'Bronce',
        'description' => 'Publica 5 posts',
        'image' => 'assets/bronce.png',
        'target_posts' => 5,
    ]);

    Post::factory()->count(5)->for($user)->create();

    event(new PostCreated($user->posts()->latest()->first()));

    $achievementId = Achievement::where('name', 'Bronce')->first()->id;

    $this->assertDatabaseHas('achievement_user', [
        'user_id' => $user->id,
        'achievement_id' => $achievementId,
    ]);
});

