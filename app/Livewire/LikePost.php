<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likeCount;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isLiked = $post->likes()->where('user_id', Auth::id())->exists();
        $this->likeCount = $post->likes()->count();
    }

    public function likeUnlike()
    {
        if ($this->isLiked) {
            $this->post->likes()->where('user_id', Auth::id())->delete();
            $this->likeCount--;
        } else {
            $this->post->likes()->create(['user_id' => Auth::id()]);
            $this->likeCount++;
        }

        $this->isLiked = !$this->isLiked;
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
