<?php

namespace App\Jobs;

use App\Mail\NewPostMailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewPostEmail
{
    use SerializesModels;

    protected $post;
    protected $userEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($post, $userEmail)
    {
        $this->post = $post;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userEmail)->send(new NewPostMailable($this->post));
    }
}

