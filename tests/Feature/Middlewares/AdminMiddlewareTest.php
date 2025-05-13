<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

it('non-admin users are redirected to home', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertStatus(403);
});

it('admins can access dashboard', function () {

    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $response = $this->actingAs($admin)->get(route('admin.dashboard'));

    $response->assertStatus(200);
});

it('admins can access users page', function () {

    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $response = $this->actingAs($admin)->get(route('admin.users'));

    $response->assertStatus(200);
});

it('admins can access posts page', function () {

    Role::create(['name' => 'admin']);

    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $response = $this->actingAs($admin)->get(route('admin.approvedPosts'));

    $response->assertStatus(200);
});
