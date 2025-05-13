<?php

use App\Events\PostLiked;
use App\Models\Post;
use App\Models\User;

it('when someone likes it the count is updated', function () {

    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create();

    $liker = User::factory()->create();

    $post->like($liker->id);

    event(new PostLiked($post));

    $user->refresh();

    expect($user->total_likes)->toBe(1);
});

