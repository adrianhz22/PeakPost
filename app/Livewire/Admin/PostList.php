<?php

namespace App\Livewire\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostList extends Component
{

    use WithFileUploads;

    public $title, $body, $image, $province, $difficulty, $longitude, $altitude, $time, $track;

    public function createPost()
    {

        $this->validate(PostRequest::creationRules());

        $imagePath = $this->image->store('posts', 'public');

        $trackPath = null;

        if ($this->track) {
            $trackPath = $this->track->store('tracks', 'public');
        }

        Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'body' => $this->body,
            'image' => "storage/$imagePath",
            'province' => $this->province,
            'difficulty' => $this->difficulty,
            'longitude' => $this->longitude,
            'altitude' => $this->altitude,
            'time' => $this->time,
            'track' => $trackPath,
            'user_id' => auth()->id(),
            'is_approved' => false,
        ]);

        $this->reset();
    }

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
