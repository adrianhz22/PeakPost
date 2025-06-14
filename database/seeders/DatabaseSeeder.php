<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(5)->create();
        $posts = Post::factory(15)->create();

        $this->call([
            RolesSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            AchievementSeeder::class,
        ]);

        foreach ($posts as $post) {

            $post->update(['user_id' => $users->random()->id]);

            Comment::factory(3)->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
