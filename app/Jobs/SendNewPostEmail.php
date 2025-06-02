<?php

namespace App\Jobs;

use App\Mail\NewPostMailable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewPostEmail
{
    use Dispatchable, SerializesModels;

    protected $post;
    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct($post, $userEmail)
    {
        $this->post = $post;
        $this->user = $userEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new NewPostMailable($this->post));
    }
}
