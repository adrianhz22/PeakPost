<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:info {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays detailed information of the specified user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');

        $user = User::where('username', $username)->first();

        if (!$user) {
            $this->error("No user was found with the username '{$username}'.");
            return 1;
        }

        $this->info("User information: {$user->username}");
        $this->line("ID: {$user->id}");
        $this->line("Name: {$user->name}");
        $this->line("Last name: {$user->last_name}");
        $this->line("Email: {$user->email}");
        $this->line("Registration date: {$user->created_at->format('d/m/Y')}");
        $this->line("Number of posts: " . $user->posts()->count());
        $this->line("Number of comments: " . $user->comments()->count());

        return 0;
    }
}
