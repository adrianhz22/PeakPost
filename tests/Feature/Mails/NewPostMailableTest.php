<?php

use App\Mail\NewPostMailable;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

test('sends a new post email', function () {
    Mail::fake();

    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    Mail::to($user)->send(new NewPostMailable($post));

    Mail::assertSent(NewPostMailable::class);
});
