<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{

    public function deletePost($postId)
    {

        $post = Post::find($postId);
        if($post){
            $post->delete();
        }

    }
    public function render()
    {
        return view('livewire.admin.post-list', [
            'posts' => Post::all()
        ]);
    }
}
