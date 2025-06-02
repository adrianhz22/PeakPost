<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Carbon\Carbon;

test('the statistics are displayed correctly.', function () {

    Carbon::setTestNow('2024-06-01');

    User::factory()->count(2)->create(['created_at' => now()->subDays(3)]);
    Post::factory()->count(4)->create(['created_at' => now()->subDays(2)]);
    Comment::factory()->count(5)->create(['created_at' => now()->subDays(1)]);

    User::factory()->create(['created_at' => now()->subDays(10)]);

    $this->artisan('stats:week-summary')
        ->expectsOutput('New users: 2')
        ->expectsOutput('New posts: 4')
        ->expectsOutput('New comments: 5')
        ->expectsOutput('Statistics generated correctly.')
        ->assertExitCode(0);

    Carbon::setTestNow();
});
