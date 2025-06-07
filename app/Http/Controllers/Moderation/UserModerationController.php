<?php

namespace App\Http\Controllers\Moderation;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserModerationController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function assignRole(User $user)
    {
        if (!$user->hasRole('moderator')) {
            $user->assignRole('moderator');
        }

        return redirect()->back();
    }

    public function removeRole(User $user)
    {
        if ($user->hasRole('moderator')) {
            $user->removeRole('moderator');
        }

        return redirect()->back();
    }
}
