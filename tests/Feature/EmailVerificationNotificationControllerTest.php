<?php

use App\Models\User;

it('sends an email verification notification', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)
        ->post(route('verification.send'))
        ->assertSessionHas('status', 'verification-link-sent');
});
