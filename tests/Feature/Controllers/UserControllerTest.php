<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('users are redirected if they try to access the admin panel', function () {

    $response = $this->get(route('admin.dashboard'));

    $response->assertRedirect(route('login'));
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
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});
