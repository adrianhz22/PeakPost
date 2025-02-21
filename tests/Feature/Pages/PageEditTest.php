<?php

use App\Models\Post;
use App\Models\User;

it('access successful to edit page', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)->get(route('edit', $post->id));

    $response->assertStatus(200);
});
