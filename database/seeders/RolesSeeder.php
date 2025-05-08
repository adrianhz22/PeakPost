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
        $mod = Role::firstOrCreate(['name' => 'moderator']);

        $permissionAdmin = Permission::create(['name' => 'has all the permissions']);
        $permissionMod = Permission::create(['name' => 'review posts']);

        $admin->givePermissionTo($permissionAdmin);
        $mod->givePermissionTo($permissionMod);

        $adminUser = User::firstOrCreate([
            'name' => 'Admin',
            'last_name' => 'Admin Admin',
            'username' => 'admin',
            'profile_photo' => 'assets/admin.jpeg',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);

        $modUser = User::firstOrCreate([
            'name' => 'Moderator',
            'last_name' => 'Mod Mod',
            'username' => 'moderator',
            'profile_photo' => 'assets/mod.jpeg',
            'email' => 'mod@mod.com',
            'password' => bcrypt('moderator123')
        ]);

        $adminUser->assignRole($admin);
        $modUser->assignRole($mod);

        $adminUser->assignRole($admin);
        $modUser->assignRole($mod);

    }
}
