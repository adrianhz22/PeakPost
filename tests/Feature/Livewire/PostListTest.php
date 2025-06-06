<?php

use App\Livewire\Admin\PostList;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('can create a post', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $image = UploadedFile::fake()->image('post.jpg');

    Livewire::test(PostList::class)
        ->set('title', 'Post de prueba')
        ->set('body', 'Este es un post de prueba para testear que se puede crear un post desde el componente de livewire')
        ->set('province', 'Murcia')
        ->set('difficulty', 'Moderado')
        ->set('longitude', '23.56')
        ->set('altitude', '1234')
        ->set('duration_hours', '12')
        ->set('duration_minutes', '40')
        ->set('image', $image)
        ->call('createPost')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'title' => 'Post de prueba',
        'province' => 'Murcia',
        'user_id' => $user->id,
    ]);
});

it('can update a post', function () {

    Storage::fake('public');

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create([
        'title' => 'Titulo original',
        'province' => 'Albacete',
        'body' => 'Contenido de prueba para comprobar que se puede actualizar un post.',
        'difficulty' => 'Dificil',
        'longitude' => 2,
        'altitude' => 150,
        'duration' => 90,
        'image' => '/storage/posts/images/foto.jpg',
        'track' => '/storage/posts/tracks/track.kml',
        'user_id' => $user->id,
    ]);

    $image = UploadedFile::fake()->image('foto.jpg');
    $track = UploadedFile::fake()->create('track.kml');

    Livewire::test(PostList::class)
        ->call('editPost', $post->id)
        ->set('title', 'Titulo actualizado')
        ->set('province', 'Murcia')
        ->set('body', 'Contenido de prueba para comprobar que se puede actualizar un post.')
        ->set('difficulty', 'Facil')
        ->set('longitude', 2)
        ->set('altitude', 150)
        ->set('duration_hours', 2)
        ->set('duration_minutes', 15)
        ->set('image', $image)
        ->set('track', $track)
        ->call('updatePost')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Titulo actualizado',
        'province' => 'Murcia',
    ]);
});

it('can remove a post', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    Livewire::test(PostList::class)
        ->call('deletePost', $post->id);

    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});

