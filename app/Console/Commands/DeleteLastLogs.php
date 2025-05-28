<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use Illuminate\Console\Command;

class DeleteLastLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:delete-last';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the last 50 logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logIds = ActivityLog::latest()->take(50)->pluck('id');

        if ($logIds->isEmpty()) {
            $this->info("There are no logs to delete.");
            return;
        }

        ActivityLog::destroy($logIds);
        $this->info("They were successfully removed {$logIds->count()} logs.");
    }

}
