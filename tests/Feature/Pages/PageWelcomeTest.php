<?php

it('access successful to welcome page', function () {

    $response = $this->get('/');

    $response->assertStatus(200);
});

it('shows login and register buttons', function () {

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee(__('Login'));
    $response->assertSee(__('Register'));

});
