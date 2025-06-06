<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserList extends Component
{
    use WithPagination;

    public $search = '';
    public $days = null;
    public $role = null;

    public $name, $last_name, $username, $email, $password;
    public $editingUserId = null;

    protected $rules = [];

    public function mount()
    {
        $this->setCreationRules();
    }

    protected function setCreationRules()
    {
        $this->rules = [
            'name' => 'required|string|min:3|max:20',
            'last_name' => 'nullable|string|min:3|max:40',
            'username' => 'required|string|min:3|max:20|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    protected function setUpdateRules()
    {
        $userId = $this->editingUserId ?? 0;

        $this->rules = [
            'name' => 'required|string|min:3|max:20',
            'last_name' => 'nullable|string|min:3|max:40',
            'username' => "required|string|min:3|max:20|unique:users,username,{$userId}",
            'email' => "required|email|unique:users,email,{$userId}",
            'password' => 'nullable|string|min:8',
        ];
    }

    public function createUser()
    {
        $this->setCreationRules();
        $this->validate();

        User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->resetForm();
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

        $this->setUpdateRules();
    }

    public function updateUser()
    {
        $this->setUpdateRules();
        $this->validate();

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
        $this->resetForm();
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }

    public function resetForm()
    {
        $this->reset(['name', 'last_name', 'username', 'email', 'password', 'editingUserId']);
        $this->setCreationRules();
    }

    public function render()
    {
        $filters = [
            'search' => $this->search,
            'days' => $this->days,
            'role' => $this->role,
        ];

        $users = User::filter($filters)->get();

        return view('livewire.admin.user-list', [
            'users' => $users,
        ]);
    }
}
