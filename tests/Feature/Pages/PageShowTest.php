<?php

use App\Models\Post;
use App\Models\User;

it('access successful to show page', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)->get(route('show', $post->id));

    $response->assertStatus(200);
});
