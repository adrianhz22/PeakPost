<?php

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

test('Post store request has expected validation rules', function () {

    $postRequest = new StorePostRequest();

    $expectedRules = [
        'title' => 'required|string|min:10',
        'body' => 'required|string|min:50',
        'image' => 'required|image',
        'province' => 'required|string',
        'difficulty' => 'required|string',
        'longitude' => 'required|numeric',
        'altitude' => 'nullable|numeric',
        'duration_hours' => 'required|integer|min:0',
        'duration_minutes' => 'required|integer|min:0|max:59',
        'track' => 'nullable|file|mimes:xml,kml',
    ];

    expect($postRequest->rules())->toEqual($expectedRules);
});

test('Post update request has expected validation rules', function () {

    $postRequest = new UpdatePostRequest();

    $expectedRules = [
        'title' => 'required|string|min:10',
        'body' => 'required|string|min:50',
        'image' => 'nullable|image',
        'province' => 'required|string',
        'difficulty' => 'required|string',
        'longitude' => 'required|numeric',
        'altitude' => 'nullable|numeric',
        'duration_hours' => 'required|integer|min:0',
        'duration_minutes' => 'required|integer|min:0|max:59',
        'track' => 'nullable|file|mimes:xml,kml',
    ];

    expect($postRequest->rules())->toEqual($expectedRules);
});
