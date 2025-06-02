<?php

use App\Models\User;
use App\Models\Post;
use Spatie\Permission\Models\Role;

test('users without the moderator role are redirected to home', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('moderation.pending-posts'));

    $response->assertStatus(403);
});

test('moderators can access pending-posts', function () {

    Role::create(['name' => 'moderator']);

    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $response = $this->actingAs($moderator)->get(route('moderation.pending-posts'));

    $response->assertStatus(200);
});

test('moderators can access pending-show', function () {

    Role::create(['name' => 'moderator']);

    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $post = Post::factory()->create();

    $response = $this->actingAs($moderator)->get(route('moderation.show', $post));

    $response->assertStatus(200);
});
