<?php

use App\Models\Post;
use App\Models\User;

it('can download a post PDF', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create();

    $response = $this->get(route('post.pdf', $post->id));

    $response->assertStatus(200);
});

it('can download terms PDF', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('terms.pdf'));

    $response->assertStatus(200);
});
