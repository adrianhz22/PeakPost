<?php

use App\Models\User;
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
