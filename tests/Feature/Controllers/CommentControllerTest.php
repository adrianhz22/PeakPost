<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

it('a user can comment', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->actingAs($user)->post(route('comments.store', $post), [
        'content' => 'Comentario de prueba',
    ]);

    $this->assertDatabaseHas('comments', ['content' => 'Comentario de prueba']);

});

it('a user can delete a comment', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $comment = Comment::factory()->create([
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);

    $this->actingAs($user)->delete(route('comments.destroy', $comment));

    $this->assertDatabaseMissing('comments', [
        'id' => $comment->id,
    ]);
});
