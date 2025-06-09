<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;

test('authenticated user can create a post', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $data = [
        'title' => 'Nuevo post',
        'body' => 'Este es un test de prueba para comprobar que todo funcione bien',
        'image' => UploadedFile::fake()->image('imagen.jpg'),
        'province' => 'Murcia',
        'difficulty' => 'Moderado',
        'longitude' => 12,
        'altitude' => 2791,
        'duration_hours' => 3,
        'duration_minutes' => 50
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
        'image' => UploadedFile::fake()->image('imagen.jpg'),
        'province' => 'Murcia',
        'difficulty' => 'Moderado',
        'longitude' => 12,
        'altitude' => 2791,
        'duration_hours' => 3,
        'duration_minutes' => 50
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
