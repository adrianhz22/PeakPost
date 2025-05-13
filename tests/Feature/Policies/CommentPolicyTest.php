<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Policies\CommentPolicy;



it('a user cannot delete comments that are not their own', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user1->id]);

    $comment = Comment::factory()->create(['user_id' => $user2->id, 'post_id' => $post->id]);

    $policy = new CommentPolicy();

    expect($policy->delete($user1, $comment))->toBeFalse();
});
