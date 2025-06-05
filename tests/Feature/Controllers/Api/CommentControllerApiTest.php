<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

test('the authenticated user can get a specific comment.', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();
    $comment = Comment::factory()->create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);
    $reply = Comment::factory()->create([
        'parent_id' => $comment->id,
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);

    $response = $this->actingAs($user, 'sanctum')
        ->getJson("/api/comments/{$comment->id}");

    $response->assertOk()
        ->assertJson([
            'id' => $comment->id,
            'content' => $comment->content,
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
});

test('getting a comment that does not exist returns 404', function () {

    $user = User::factory()->create();

    $this->actingAs($user, 'sanctum')
        ->getJson('/api/comments/999999')
        ->assertStatus(404);
});
