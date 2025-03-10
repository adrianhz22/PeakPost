<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class TotalPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays all posts in the data database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $posts = Post::count();

        $this->info($posts);

    }
}
