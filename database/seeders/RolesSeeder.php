<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Role::firstOrCreate(['name' => 'admin']);

        $permissionAdmin = Permission::create(['name' => 'has all the permissions']);

        $admin->givePermissionTo($permissionAdmin);

        $user = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);

        $user->assignRole($admin);

        if (!$user->hasRole('admin')) {
            $user->assignRole($admin);
        }
    }
}
