<?php

it('access successful to welcome page', function () {

    $response = $this->get('/');

    $response->assertStatus(200);
});
