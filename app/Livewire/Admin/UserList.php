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

    public $editingUserId = null;

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

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $userId;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = null;
    }

    public function updateUser()
    {
        $user = User::findOrFail($this->editingUserId);

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->editingUserId = null;
    }

    public function render()
    {
        return view('livewire.admin.user-list', [
            'users' => User::all()
        ]);
    }
}


