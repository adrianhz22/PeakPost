<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Achievement;

use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    actingAs(User::factory()->create());
});

test('list the user that has been searched', function () {

    User::factory()->create(['name' => 'Antonio']);
    User::factory()->create(['name' => 'Pepe', 'username' => 'pepe_']);

    $response = get(route('users.index', ['search' => 'pepe']));

    $response->assertStatus(200);
    $response->assertSee('pepe_');
    $response->assertDontSee('Antonio');
});

test('show the user profile', function () {

    $user = User::factory()->create();
    $achievement = Achievement::factory()->create();

    $user->achievements()->attach($achievement->id);

    $response = get(route('users.show', $user));

    $response->assertStatus(200);
    $response->assertSee($user->username);
    $response->assertSee($achievement->name);
});

test('can view a user followers', function () {

    $user = User::factory()->create();
    $follower = User::factory()->create();

    $user->followers()->attach($follower);

    $response = get(route('users.followers', $user));

    $response->assertStatus(200);
    $response->assertSee($follower->username);
});

test('can view a user following', function () {

    $user = User::factory()->create();
    $followed = User::factory()->create();

    $user->following()->attach($followed);

    $response = get(route('users.following', $user));

    $response->assertStatus(200);
    $response->assertSee($followed->username);
});

test('admin can view the users list', function () {

    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertStatus(200);
});

test('admin can delete a user', function () {

    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $user = User::factory()->create();

    $response = $this->actingAs($admin)->delete(route('admin.destroy', $user));

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertDatabaseMissing('users', ['id' => $user->username]);
});

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

    $this->deleteJson("/api/users/{$userDelete->username}")
        ->assertStatus(200);

    $this->assertDatabaseMissing('users', ['id' => $userDelete->id]);
});

test('show detail user using the API', function () {

    $admin = User::factory()->create()->assignRole(Role::create(['name' => 'admin']));
    $this->actingAs($admin);

    $user = User::factory()->create();

    $this->getJson("/api/users/{$user->username}")
        ->assertStatus(200);
});

test('update a user using the API', function () {

    $admin = User::factory()->create()->assignRole(Role::create(['name' => 'admin']));
    $this->actingAs($admin);

    $user = User::factory()->create();

    $this->putJson("/api/users/{$user->username}", [
        'name' => 'Ejemplo',
        'last_name' => 'Ejemplo Ejemplo',
        'username' => 'ejemplo_',
        'email' => 'ejemplo@example.com',
        'password' => 'ejemplo123',
    ])
        ->assertStatus(200);

    $this->assertDatabaseHas('users', ['email' => 'ejemplo@example.com']);
});
