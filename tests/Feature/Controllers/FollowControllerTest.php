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

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $user1->follow($user2);

    $this->assertDatabaseHas('follows', [
        'follower_id' => $user1->id,
        'followed_id' => $user2->id,
    ]);

    $this->actingAs($user1)->delete(route('unfollow', $user2));

    $this->assertDatabaseMissing('follows', [
        'follower_id' => $user1->id,
        'followed_id' => $user2->id,
    ]);
});
