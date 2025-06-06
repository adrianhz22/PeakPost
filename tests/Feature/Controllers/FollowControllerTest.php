<?php

use App\Models\User;

it('a user can follow another user', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $this->assertFalse($user1->isFollowing($user2));

    $this->actingAs($user1)->post(route('follow', $user2));

    $this->assertTrue($user1->isFollowing($user2));
});

it('a user can unfollow another user', function () {

    $follower = User::factory()->create();
    $followed = User::factory()->create();

    $follower->following()->attach($followed->id);

    $this->actingAs($follower)
        ->delete(route('unfollow', $followed));

    $this->assertDatabaseMissing('follows', [
        'follower_id' => $follower->id,
        'followed_id' => $followed->id,
    ]);
});
