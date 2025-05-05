<?php

use App\Models\Post;
use App\Models\User;

it('displays the count of approved posts', function () {

    $user = User::factory()->create();

    Post::factory()->count(3)->create(['user_id' => $user->id, 'status' => 'approved']);

    $this->artisan('posts:approved')
        ->expectsOutput('3')
        ->assertExitCode(0);
});
