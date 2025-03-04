<?php

use App\Models\User;

it('access successful to user-posts page', function () {

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('posts.user-posts'));

    $response->assertStatus(200);
});
