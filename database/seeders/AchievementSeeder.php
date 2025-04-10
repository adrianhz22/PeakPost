<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Achievement::create([
            'name' => 'Bronce',
            'description' => 'Publica 5 posts',
            'image' => 'achievements/bronce.png',
        ]);

        Achievement::create([
            'name' => 'Plata',
            'description' => 'Publica 20 posts',
            'image' => 'achievements/plata.png',
        ]);

        Achievement::create([
            'name' => 'Oro',
            'description' => 'Publica 50 posts',
            'image' => 'achievements/oro.png',
        ]);
    }
}
