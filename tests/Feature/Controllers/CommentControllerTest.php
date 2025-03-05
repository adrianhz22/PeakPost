<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

it('an authenticated user can comment', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->actingAs($user)->post(route('comments.store', $post), [
        'content' => 'Testing comment',
    ]);

    $this->assertDatabaseHas(Comment::class, ['content' => 'Testing comment']);

});

it('an not authenticated user cant comment', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->post(route('comments.store', $post), [
        'content' => 'Testing comment',
        ])->assertRedirect(route('login'));

    $this->assertDatabaseCount(Comment::class, 0);

});
