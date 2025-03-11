<?php

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;

it('a user can update his own post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $policy = new PostPolicy();

    expect($policy->update($user, $post))->toBeTrue();
});

it('a user cannot update a post that is not theirs', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user2->id]);

    $policy = new PostPolicy();

    expect($policy->update($user1, $post))->toBeFalse();
});

it('a user can delete his own post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    $policy = new PostPolicy();

    expect($policy->delete($user, $post))->toBeTrue();
});

it('a user cannot delete a post that is not theirs', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user2->id]);

    $policy = new PostPolicy();

    expect($policy->delete($user1, $post))->toBeFalse();
});
