<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function userLikedPosts()
    {

        $user = Auth::user();
        $likedPosts = $user->likedPosts()->paginate(12);

        return view('posts.my-likes', compact('likedPosts'));

    }
}
