<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    public function created(User $user)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Usuario creado',
            'description' => "Se ha creado el usuario {$user->username}."
        ]);
    }

    public function updated(User $user)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Usuario actualizado',
            'description' => "Se ha actualizado el usuario {$user->username}."
        ]);
    }

    public function deleted(User $user)
    {
        if (!Auth::user()) return;

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Usuario eliminado',
            'description' => "El usuario {$user->username} ha sido eliminado."
        ]);
    }
}
