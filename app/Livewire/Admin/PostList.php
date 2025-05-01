<?php

namespace App\Livewire\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostList extends Component
{

    use WithFileUploads;

    public $title, $body, $image, $province, $difficulty, $longitude, $altitude, $time, $track;
    public $editingPostId = null;

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

    public function editPost($postId)
    {
        $post = Post::findOrFail($postId);

        $this->editingPostId = $post->id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->province = $post->province;
        $this->difficulty = $post->difficulty;
        $this->longitude = $post->longitude;
        $this->altitude = $post->altitude;
        $this->time = $post->time;
        $this->image = $post->image;
        $this->track = $post->track;
    }

    public function updatePost()
    {
        $updateRules = PostRequest::updateRules();

        $rules = collect($updateRules)->except(['image', 'track'])->toArray();

        if ($this->image instanceof UploadedFile) {
            $rules['image'] = $updateRules['image'];
        }

        if ($this->track instanceof UploadedFile) {
            $rules['track'] = $updateRules['track'];
        }

        $this->validate($rules);

        $post = Post::findOrFail($this->editingPostId);

        $post->title = $this->title;
        $post->slug = Str::slug($this->title);
        $post->body = $this->body;
        $post->province = $this->province;
        $post->difficulty = $this->difficulty;
        $post->longitude = $this->longitude;
        $post->altitude = $this->altitude;
        $post->time = $this->time;

        if ($this->image instanceof UploadedFile) {
            $post->image = 'storage/' . $this->image->store('posts', 'public');
        }

        if ($this->track instanceof UploadedFile) {
            $post->track = $this->track->store('tracks', 'public');
        }

        $post->save();

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'title', 'body', 'image', 'province', 'difficulty',
            'longitude', 'altitude', 'time', 'track', 'editingPostId'
        ]);
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
