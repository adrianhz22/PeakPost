<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'last_name' => 'Test Last Name',
        'username' => 'Test_user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'accepted_terms_at' => now(),
        'terms' => true,
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));
});
