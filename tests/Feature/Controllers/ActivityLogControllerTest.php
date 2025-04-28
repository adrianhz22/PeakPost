<?php

it('it redirects to login if user is not authenticated', function () {

    $response = $this->get('/admin/historial');

    $response->assertRedirect(route('login'));

    $response->assertStatus(302);
});
