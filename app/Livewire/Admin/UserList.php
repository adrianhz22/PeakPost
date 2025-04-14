<?php

namespace App\Livewire\Admin;

use App\Http\Requests\UserRequest;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class UserList extends Component
{

    public $name, $email, $password;

    public function createUser()
    {
        $this->validate(UserRequest::creationRules());

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset();
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Usuario eliminado',
                'description' => "El usuario {$user->name} ha sido eliminado."
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.user-list', [
            'users' => User::all()
        ]);
    }
}


