<?php

use App\Models\Post;
use App\Models\User;

it('displays the count of pending posts', function () {

    $user = User::factory()->create();

    Post::factory()->count(3)->create(['user_id' => $user->id, 'is_approved' => 0]);

    $this->artisan('posts:pending')
        ->expectsOutput('3')
        ->assertExitCode(0);
});
