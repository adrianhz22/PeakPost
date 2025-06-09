<?php

namespace App\Jobs;

use App\Mail\ApprovedPostEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendApprovedPostEmail implements ShouldQueue
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
        Mail::to($this->user->email)->send(new ApprovedPostEmail($this->post));
    }
}

