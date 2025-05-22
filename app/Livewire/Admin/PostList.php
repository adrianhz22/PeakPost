<?php

namespace App\Livewire\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PostList extends Component
{

    use WithFileUploads, WithPagination;

    public $title, $body, $image, $province, $difficulty, $longitude, $altitude, $durationHours, $durationMinutes, $track;
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
            'image' => "/storage/$imagePath",
            'province' => $this->province,
            'difficulty' => $this->difficulty,
            'longitude' => $this->longitude,
            'altitude' => $this->altitude,
            'duration' => ($this->durationHours * 60) + $this->durationMinutes,
            'track' => $trackPath,
            'user_id' => auth()->id(),
            'status' => 'pending',
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
        $this->durationHours = floor($post->duration / 60);
        $this->durationMinutes = floor($post->duration % 60);
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
        $post->duration = ($this->durationHours * 60) + $this->durationMinutes;

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
            'longitude', 'altitude', 'durationHours', 'durationMinutes', 'track', 'editingPostId'
        ]);
    }

    public function deletePost($postId)
    {

        $post = Post::findOrFail($postId);

        $post->delete();

    }
    public function render()
    {
        return view('livewire.admin.post-list', [
            'posts' => Post::latest()->paginate(10)
        ]);
    }
}
