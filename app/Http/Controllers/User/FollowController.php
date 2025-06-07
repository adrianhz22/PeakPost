<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->id !== $user->id && !$currentUser->following()->where('followed_id', $user->id)->exists()) {
            $currentUser->following()->attach($user->id);
        }

        return back();
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);

        return back();
    }
}
