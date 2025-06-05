<?php

namespace App\Livewire\Admin;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $search = '';
    public $name, $last_name, $username, $email, $password;
    public $editingUserId = null;
    public $days = null;

    public function createUser()
    {
        $this->validate(UserRequest::creationRules());

        User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset();
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $userId;

        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = null;
    }

    public function updateUser()
    {
        $this->validate(UserRequest::updateRules($this->editingUserId));

        $user = User::findOrFail($this->editingUserId);

        $user->update([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $user->password = Hash::make($this->password);
            $user->save();
        }

        $this->editingUserId = null;
    }

    public function resetForm()
    {
        $this->name = '';
        $this->last_name = '';
        $this->username = '';
        $this->email = '';
        $this->password = '';
        $this->editingUserId = null;
    }

    public function render()
    {
        $filters = [
            'search' => request('search'),
            'days' => request('days'),
            'role' => request('role')
        ];

        $users = User::filter($filters)->get();

        return view('livewire.admin.user-list', [
            'users' => $users,
        ]);
    }

}
