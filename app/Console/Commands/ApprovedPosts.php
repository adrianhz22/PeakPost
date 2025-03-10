<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class ApprovedPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:approved';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays all approved posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $approved_posts = Post::where('is_approved', 1)->count();

        $this->info($approved_posts);

    }
}
