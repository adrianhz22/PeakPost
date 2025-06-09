<?php

use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('moderator can approve a post', function () {

    Role::create(['name' => 'moderator']);

    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $post = Post::factory()->create(['status' => 'pending']);

    $this->actingAs($moderator);

    $response = $this->put(route('moderation.approve', $post));

    $response->assertRedirect(route('moderation.pending-posts'));
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'status' => 'approved']);
});

test('moderator can reject a post', function () {

    Role::create(['name' => 'moderator']);

    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $post = Post::factory()->create(['status' => 'pending']);

    $this->actingAs($moderator);

    $response = $this->patch(route('moderation.reject', $post), [
        'rejection_reason' => 'Contenido inapropiado'
    ]);

    $response->assertRedirect(route('moderation.pending-posts'));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'status' => 'rejected'
    ]);
});

