<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('return a list of users', function () {

    $admin = Role::create(['name' => 'admin']);
    $user = User::factory()->create()->assignRole($admin);

    $this->actingAs($user);
    User::factory(3)->create();

    $this->getJson('/api/users')
        ->assertStatus(200);
});

test('create a user successfully', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $userData = [
        'name' => 'Ejemplo',
        'last_name' => 'Ejemplo Ejemplo',
        'username' => 'ejemplo_',
        'email' => 'ejemplo@example.com',
        'password' => 'ejemplo123',
    ];

    $response = $this->postJson('/api/users', $userData);

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', ['email' => 'ejemplo@example.com']);
});

test('an admin can delete users', function () {

    $admin = User::factory()->create()->assignRole(Role::create(['name' => 'admin']));
    $this->actingAs($admin);

    $userDelete = User::factory()->create();

    $this->deleteJson("/api/users/{$userDelete->id}")
        ->assertStatus(200);

    $this->assertDatabaseMissing('users', ['id' => $userDelete->id]);
});

test('show detail user using the API', function () {

    $admin = User::factory()->create()->assignRole(Role::create(['name' => 'admin']));
    $this->actingAs($admin);

    $user = User::factory()->create();

    $this->getJson("/api/users/{$user->id}")
        ->assertStatus(200);
});

test('update a user using the API', function () {

    $admin = User::factory()->create()->assignRole(Role::create(['name' => 'admin']));
    $this->actingAs($admin);

    $user = User::factory()->create();

    $this->putJson("/api/users/{$user->id}", [
        'name' => 'Ejemplo',
        'last_name' => 'Ejemplo Ejemplo',
        'username' => 'ejemplo_',
        'email' => 'ejemplo@example.com',
        'password' => 'ejemplo123',
    ])
        ->assertStatus(200);

    $this->assertDatabaseHas('users', ['email' => 'ejemplo@example.com']);
});
