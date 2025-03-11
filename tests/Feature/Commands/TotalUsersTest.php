<?php

use App\Models\User;

it('displays the count of total users', function () {

    User::factory()->count(3)->create();

    $this->artisan('users:total')
        ->expectsOutput('3')
        ->assertExitCode(0);
});
