<?php

use App\Models\User;

it('access successful to create page', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('create'));

    $response->assertStatus(200);
});
