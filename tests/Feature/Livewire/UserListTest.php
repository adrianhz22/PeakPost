<?php

use App\Livewire\Admin\UserList;
use App\Models\User;
use Livewire\Livewire;

it('can create a user', function () {

    Livewire::test(UserList::class)
        ->set('name', 'Test')
        ->set('last_name', 'Test Test')
        ->set('username', 'testuser')
        ->set('email', 'test@example.com')
        ->set('password', '12345678')
        ->call('createUser');

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'username' => 'testuser',
    ]);
});

it('can update a user', function () {

    $user = User::factory()->create([
        'username' => 'testuser',
        'email' => 'test@example.com',
    ]);

    Livewire::test(UserList::class)
        ->call('editUser', $user->id)
        ->set('username', 'nuevo_usuario')
        ->set('email', 'nuevo@email.com')
        ->call('updateUser');

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'username' => 'nuevo_usuario',
        'email' => 'nuevo@email.com',
    ]);
});

it('can delete a user', function () {

    $user = User::factory()->create();

    Livewire::test(UserList::class)
        ->call('deleteUser', $user->id);

    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);
});
