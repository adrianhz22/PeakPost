<?php

namespace App\Jobs;

use App\Mail\RejectedPostEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRejectedPostEmail implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $post;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new RejectedPostEmail($this->post));
    }
}
