<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TotalUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays all registered users in the data database';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $users = User::count();

        $this->info($users);

    }
}
