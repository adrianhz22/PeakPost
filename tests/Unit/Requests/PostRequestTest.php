<?php

use App\Http\Requests\PostRequest;

test('Post request has expected validation rules', function () {

    $postRequest = new PostRequest();

    $expectedRules = [
        'title' => 'required|string|min:10',
        'slug' => 'nullable|string',
        'body' => 'required|string|min:50',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    expect($postRequest->rules())->toEqual($expectedRules);
});
