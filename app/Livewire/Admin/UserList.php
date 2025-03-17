<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class UserList extends Component
{
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
        }
    }

    public function render()
    {
        return view('livewire.admin.user-list', [
            'users' => User::all()
        ]);
    }
}


