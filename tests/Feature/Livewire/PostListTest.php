<?php

use App\Livewire\Admin\PostList;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
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

    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create([
        'title' => 'Titulo original',
        'province' => 'Albacete',
        'user_id' => $user->id,
    ]);

    Livewire::test(PostList::class)
        ->call('editPost', $post->id)
        ->set('title', 'Titulo actualizado')
        ->set('province', 'Murcia')
        ->call('updatePost');

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

