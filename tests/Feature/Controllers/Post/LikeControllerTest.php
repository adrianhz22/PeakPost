<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;

test('a user can view a list of posts they have liked', function () {

    $user = User::factory()->create();
    $posts = Post::factory()->count(3)->create();

    foreach ($posts as $post) {
        $post->like($user->id);
    }

    actingAs($user)
        ->get(route('posts.liked'))
        ->assertOk()
        ->assertViewIs('posts.my-likes')
        ->assertViewHas('likedPosts', function ($collection) use ($posts) {
            return $collection->pluck('id')->diff($posts->pluck('id'))->isEmpty();
        });
});
