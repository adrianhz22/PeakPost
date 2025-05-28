<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOldRejected extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete-old-rejected';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove rejected posts older than 3 months';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $limitDate = Carbon::now()->subMonths(3);

        $posts = Post::where('status', 'rejected')
            ->where('created_at', '<', $limitDate)
            ->get();

        $count = $posts->count();

        if ($count === 0) {
            $this->info('There are no old rejected posts to delete.');
            return 0;
        }

        foreach ($posts as $post) {

            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            if ($post->track && Storage::disk('public')->exists($post->track)) {
                Storage::disk('public')->delete($post->track);
            }

            $post->delete();
        }

        $this->info("$count rejected posts older than 3 months were deleted.");

        return 0;
    }
}
