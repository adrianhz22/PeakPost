<?php

use App\Http\Requests\CommentRequest;

test('Comment request has expected validation rules', function () {

    $commentRequest = new CommentRequest();

    $expectedRules = [
        'content' => 'required|max:200',
    ];

    expect($commentRequest->rules())->toEqual($expectedRules);
});
