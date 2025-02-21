<?php

use App\Models\User;

it('access successful to home page', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertStatus(200);
});
