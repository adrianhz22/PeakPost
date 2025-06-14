<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12);

        return view('users.index', compact('users', 'search'));
    }

    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('admin.dashboard');

    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
            'posts' => $user->posts()->latest()->get(),
            'postCount' => $user->posts()->count(),
            'allAchievements' => Achievement::all(),
            'userAchievementIds' => $user->achievements->pluck('id')->toArray(),

            'followersCount' => $user->followers()->count(),
            'followingCount' => $user->following()->count(),
        ]);
    }

    public function followers(User $user)
    {
        $followers = $user->followers;

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers
        ]);
    }

    public function following(User $user)
    {
        $following = $user->following;

        return view('users.following', [
            'user' => $user,
            'following' => $following
        ]);
    }

}
