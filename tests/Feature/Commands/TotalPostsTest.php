<?php

use App\Models\Post;
use App\Models\User;

it('displays the count of total posts', function () {

    $user = User::factory()->create();

    Post::factory()->count(5)->create(['user_id' => $user->id, 'status' => 'pending']);
    Post::factory()->count(5)->create(['user_id' => $user->id, 'status' => 'approved']);

    $this->artisan('posts:total')
        ->expectsOutput('10')
        ->assertExitCode(0);
});
