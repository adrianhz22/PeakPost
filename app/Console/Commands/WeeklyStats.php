<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class WeeklyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:week-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate statistics from the last week';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sinceDate = Carbon::now()->subDays(7);

        $newUsers = User::where('created_at', '>=', $sinceDate)->count();
        $newPosts = Post::where('created_at', '>=', $sinceDate)->count();
        $newComments = Comment::where('created_at', '>=', $sinceDate)->count();

        $this->info("Statistics from the last 7 days:");
        $this->line("New users:     $newUsers");
        $this->line("New posts:     $newPosts");
        $this->line("New comments:  $newComments");

        $this->info('Statistics generated correctly.');
    }
}
