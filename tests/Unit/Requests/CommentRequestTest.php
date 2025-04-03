<?php

use App\Http\Requests\CommentRequest;

test('Comment request has expected validation rules', function () {

    $commentRequest = new CommentRequest();

    $expectedRules = [
        'content' => 'required|max:200',
        'parent_id' => 'nullable|exists:comments,id'
    ];

    expect($commentRequest->rules())->toEqual($expectedRules);
});
