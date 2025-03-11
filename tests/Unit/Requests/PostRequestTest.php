<?php

use App\Http\Requests\PostRequest;

test('Post request has expected validation rules', function () {

    $postRequest = new PostRequest();

    $expectedRules = [
        'title' => 'required|string|min:10',
        'slug' => 'nullable|string',
        'body' => 'required|string|min:50',
        'image' => 'required|string',
        'province' => 'required|string',
        'difficulty' => 'required|string',
        'longitude' => 'required|numeric',
        'altitude' => 'nullable|numeric',
        'time' => 'nullable|date-format:H:i:s',
        'track' => 'nullable|file|mimes:xml,kml',
    ];

    expect($postRequest->rules())->toEqual($expectedRules);
});
