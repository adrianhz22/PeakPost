<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

test('the user data is shown if the user exists', function () {

    $user = User::factory()->create([
        'username' => 'testuser',
        'name' => 'Test',
        'last_name' => 'Test Test',
        'email' => 'test@example.com',
        'created_at' => now()->subDays(5),
    ]);

    Post::factory()->count(3)->create(['user_id' => $user->id]);
    Comment::factory()->count(2)->create(['user_id' => $user->id]);

    $this->artisan('user:info', ['username' => 'testuser'])
        ->expectsOutput("User information: testuser")
        ->expectsOutput("ID: {$user->id}")
        ->expectsOutput("Name: Test")
        ->expectsOutput("Last name: Test Test")
        ->expectsOutput("Email: test@example.com")
        ->expectsOutput("Number of posts: 3")
        ->expectsOutput("Number of comments: 2")
        ->assertExitCode(0);
});

test('an error is shown if the user is not found.', function () {

    $this->artisan('user:info', ['username' => 'noexiste'])
        ->expectsOutput("No user was found with the username 'noexiste'.")
        ->assertExitCode(1);
});
