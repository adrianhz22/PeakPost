<?php

use App\Http\Requests\ImageRequest;

test('Image request has expected validation rules', function () {

    $imageRequest = new ImageRequest();

    $expectedRules = [
        'image' => 'required|image',
        'title' => 'required|string|max:30',
    ];

    expect($imageRequest->rules())->toEqual($expectedRules);
});
