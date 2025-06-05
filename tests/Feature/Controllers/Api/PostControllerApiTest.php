<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('create a post using the API', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = [
        'title' => 'Titulo de prueba',
        'body' => 'Contenido de prueba este post esta creado para el test',
        'image' => UploadedFile::fake()->image('imagen.jpg'),
        'province' => 'Granada',
        'difficulty' => 'Moderado',
        'longitude' => 14,
        'altitude' => 2612,
        'duration_hours' => 3,
        'duration_minutes' => 50,
        'user_id' => $user->id,
    ];

    $response = $this->post('/api/posts', $post, ['Accept' => 'application/json']);

    $response->assertStatus(201);
    $this->assertDatabaseHas('posts', ['title' => 'Titulo de prueba']);
});

test('delete a post using the API', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->deleteJson("/api/posts/{$post->id}");

    $response->assertStatus(200);
});

test('show detail post using the API', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    $response = $this->getJson("/api/posts/{$post->id}");

    $response->assertStatus(200);
});

test('update a post using the API', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    $updatedPost = [
        'title' => 'Titulo de prueba',
        'body' => 'Contenido de prueba este post esta creado para el test',
        'image' => UploadedFile::fake()->image('imagen.jpg'),
        'province' => 'Granada',
        'difficulty' => 'Moderado',
        'longitude' => 14,
        'altitude' => 2612,
        'duration_hours' => 3,
        'duration_minutes' => 50,
    ];

    $response = $this->patch("/api/posts/{$post->id}", $updatedPost, [
        'Accept' => 'application/json',
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'Titulo de prueba']);
});
