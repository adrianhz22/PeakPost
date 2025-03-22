<?php

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

it('a comment belongs to a user', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $comment = Comment::factory()->create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);

    expect($comment->user)->toBeInstanceOf(User::class);
});

it('a comment belongs to a post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $comment = Comment::factory()->create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);

    expect($comment->post)->toBeInstanceOf(Post::class);
});
