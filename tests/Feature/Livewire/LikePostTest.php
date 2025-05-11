<?php

use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

it('can like a post', function () {

    $user = User::factory()->create();
    $post = Post::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test('like-post', ['post' => $post]);

    $component->assertSet('isLiked', false);
    $component->assertSet('likeCount', 0);

    $component->call('likeUnlike')
        ->assertSet('isLiked', true)
        ->assertSet('likeCount', 1);

});
