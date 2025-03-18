<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

it('access successful to admin-dashboard page', function () {

    Role::create(['name' => 'admin']);

    $user = User::factory()->create();
    $user->assignRole('admin');

    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertStatus(200);
});
