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
        'name' => 'Test',
        'last_name' => 'User',
        'username' => 'testuser',
        'email' => 'test@example.com',
    ]);

    Livewire::test(UserList::class)
        ->call('editUser', $user->id)
        ->set('name', $user->name)
        ->set('last_name', $user->last_name)
        ->set('username', 'nuevo_usuario')
        ->set('email', 'nuevo@email.com')
        ->call('updateUser')
        ->assertHasNoErrors();

    $user->refresh();

    $this->assertEquals('nuevo_usuario', $user->username);
    $this->assertEquals('nuevo@email.com', $user->email);
});


it('can delete a user', function () {

    $user = User::factory()->create();

    Livewire::test(UserList::class)
        ->call('deleteUser', $user->id);

    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);
});
