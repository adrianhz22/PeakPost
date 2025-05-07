<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Juan',
                'last_name' => 'Perez Fernandez',
                'username' => 'jperez_87',
                'email' => 'jperez87@gmail.com',
                'password' => '12345678',
                'profile_photo' => 'assets/perfil1.jpg',
            ],
            [
                'name' => 'Jaime',
                'last_name' => 'Muñoz Robles',
                'username' => 'jaime3899',
                'email' => 'jaimemunoz34@gmail.com',
                'password' => '12345678',
                'profile_photo' => 'assets/perfil2.jpg',
            ],
            [
                'name' => 'Antonio',
                'last_name' => 'Jimenez Rueda',
                'username' => 'tony_mountain2',
                'email' => 'antonioj56@gmail.com',
                'password' => '12345678',
                'profile_photo' => 'assets/perfil3.jpg',
            ],
            [
                'name' => 'Paula',
                'last_name' => 'Poveda Marin',
                'username' => 'pau_pm',
                'email' => 'paulapm22@gmail.com',
                'password' => '12345678',
                'profile_photo' => 'assets/perfil4.jpg',
            ],
            [
                'name' => 'Inés',
                'last_name' => 'Chicote Rodriguez',
                'username' => 'ichiro_',
                'email' => 'ines_chi67@gmail.com',
                'password' => '12345678',
                'profile_photo' => 'assets/perfil5.jpg',
            ],
            [
                'name' => 'Marta',
                'last_name' => 'Hernandez Sanchez',
                'username' => 'marta_train02',
                'email' => 'marta02@gmail.com',
                'password' => '12345678',
                'profile_photo' => 'assets/perfil6.jpg',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
