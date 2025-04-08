<?php

use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('authenticated user can create a post', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'title' => 'Nuevo post',
        'body' => 'Este es un test de prueba para comprobar que todo funcione bien',
        'image' => 'imagen.jpg',
        'province' => 'Murcia',
        'difficulty' => 'Moderado',
        'longitude' => 12,
        'altitude' => 2791,
        'time' => '02:37:13',
    ];

    $response = $this->post(route('posts.store'), $data);

    $response->assertRedirect(route('home'));
    $this->assertDatabaseHas('posts', ['title' => 'Nuevo post', 'user_id' => $user->id]);
});

test('user can update their post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $data = [
        'title' => 'Titulo actualizado',
        'body' => 'Este es un test de prueba para comprobar que todo funcione bien',
        'image' => 'imagen.jpg',
        'province' => 'Murcia',
        'difficulty' => 'Moderado',
        'longitude' => 12,
        'altitude' => 2791,
        'time' => '02:37:13',
    ];

    $response = $this->put(route('posts.update', $post), $data);

    $response->assertRedirect(route('home'));
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'Titulo actualizado']);
});

test('user can delete their post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = $this->delete(route('posts.destroy', $post));

    $response->assertRedirect(route('home'));
    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});

test('moderator can approve a post', function () {

    Role::create(['name' => 'moderator']);

    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $post = Post::factory()->create(['is_approved' => false]);

    $this->actingAs($moderator);

    $response = $this->put(route('moderation.approve', $post));

    $response->assertRedirect(route('moderation.pending-posts'));
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'is_approved' => true]);
});

test('moderator can reject a post', function () {

    Role::create(['name' => 'moderator']);

    $moderator = User::factory()->create();
    $moderator->assignRole('moderator');

    $post = Post::factory()->create(['is_approved' => false]);

    $this->actingAs($moderator);

    $response = $this->delete(route('moderation.reject', $post));

    $response->assertRedirect(route('moderation.pending-posts'));
    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});

test('create a post using the API', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = [
        'title' => 'Titulo de prueba',
        'body' => 'Contenido de prueba este post esta creado para el test',
        'image' => 'imagen.jpg',
        'province' => 'Granada',
        'difficulty' => 'Moderado',
        'longitude' => 14,
        'altitude' => 2612,
        'user_id' => $user->id,
    ];

    $response = $this->postJson('/api/posts', $post);

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
        'image' => 'imagen.jpg',
        'province' => 'Granada',
        'difficulty' => 'Moderado',
        'longitude' => 14,
        'altitude' => 2612,
    ];

    $response = $this->putJson("/api/posts/{$post->id}", $updatedPost);

    $response->assertStatus(200);
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'Titulo de prueba']);
});
