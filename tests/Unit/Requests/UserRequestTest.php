<?php

use App\Http\Requests\StoreUserRequest;

test('User store request has expected validation rules', function () {

    $userRequest = new StoreUserRequest();

    $expectedRules = [
        'name' => 'required|string|min:3|max:20',
        'last_name' => 'nullable|string|min:3|max:40',
        'username' => 'required|string|min:3|max:20|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ];

    expect($userRequest->rules())->toEqual($expectedRules);
});
