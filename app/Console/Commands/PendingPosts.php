<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PendingPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays all pending posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $pending_posts = Post::where('is_approved', 0)->count();

        $this->info($pending_posts);

    }
}
