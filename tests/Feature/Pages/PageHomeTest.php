<?php

use App\Models\Post;
use App\Models\User;

it('access successful to home page', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertStatus(200);
});

it('show info posts', function () {

    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
        'title' => 'Post de prueba',
        'body' => 'Contenido del post de prueba',
    ]);

    $this->actingAs($user);

    $response = $this->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee($post->title);
    $response->assertSee($post->body);

});
