<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

it('admin can access activity log', function () {

    $user = User::factory()->create();
    Role::firstOrCreate(['name' => 'admin']);
    $user->assignRole('admin');

    $this->actingAs($user);

    $response = $this->get(route('admin.activity-log'));

    $response->assertStatus(200);

});
