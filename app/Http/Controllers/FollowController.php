<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        auth()->user()->follow($user);
        return back();
    }

    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }
}
