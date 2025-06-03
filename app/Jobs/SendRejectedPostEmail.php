<?php

namespace App\Jobs;

use App\Mail\ApprovedPostEmail;
use App\Mail\RejectedPostEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendRejectedPostEmail implements ShouldQueue
{
    use Queueable;

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
