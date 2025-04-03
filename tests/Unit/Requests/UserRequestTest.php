<?php

use App\Http\Requests\UserRequest;

test('User request has expected validation rules', function () {

    $userRequest = new UserRequest();

    $expectedRules = [
        'name' => 'required|string|max:40',
        'email' => 'required',
        'password' => 'required|string|min:8',
    ];

    expect($userRequest->rules())->toEqual($expectedRules);
});
