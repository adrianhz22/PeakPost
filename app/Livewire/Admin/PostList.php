<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithFileUploads, WithPagination;

    public $title, $body, $image, $province, $provinces = [], $difficulty, $difficulties = [], $longitude, $altitude, $duration_hours, $duration_minutes, $track;
    public $editingPostId = null;

    protected $rules = [];

    public function mount()
    {
        $this->provinces = config('lists.provinces');
        $this->province = old('province', '');
        $this->difficulties = config('lists.difficulties');
        $this->difficulty = old('difficulty', '');

        $this->setCreationRules();
    }

    protected function setCreationRules()
    {
        $this->rules = [
            'title' => 'required|string|min:10',
            'body' => 'required|string|min:50',
            'image' => 'required|image',
            'province' => 'required|string',
            'difficulty' => 'required|string',
            'longitude' => 'required|numeric',
            'altitude' => 'nullable|numeric',
            'duration_hours' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:0|max:59',
            'track' => 'nullable|file|mimes:xml,kml',
        ];
    }

    protected function setUpdateRules()
    {
        $rules = [
            'title' => 'required|string|min:10',
            'body' => 'required|string|min:50',
            'image' => 'nullable|image',
            'province' => 'required|string',
            'difficulty' => 'required|string',
            'longitude' => 'required|numeric',
            'altitude' => 'nullable|numeric',
            'duration_hours' => 'required|integer|min:0',
            'duration_minutes' => 'required|integer|min:0|max:59',
            'track' => 'nullable|file|mimes:xml,kml',
        ];

        if ($this->image instanceof UploadedFile) {
            $rules['image'] = 'required|image';
        }
        if ($this->track instanceof UploadedFile) {
            $rules['track'] = 'required|file|mimes:xml,kml';
        }

        $this->rules = $rules;
    }

    public function createPost()
    {
        $this->setCreationRules();
        $this->validate();

        $post = Post::create($this->preparePostData());

        $this->resetForm();
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
        $this->duration_hours = floor($post->duration / 60);
        $this->duration_minutes = floor($post->duration % 60);
        $this->image = $post->image;
        $this->track = $post->track;

        $this->setUpdateRules();
    }

    public function updatePost()
    {
        $this->setUpdateRules();
        $this->validate();

        $post = Post::findOrFail($this->editingPostId);
        $post->fill($this->preparePostData())->save();

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'title', 'body', 'image', 'province', 'difficulty',
            'longitude', 'altitude', 'duration_hours', 'duration_minutes', 'track', 'editingPostId'
        ]);

        $this->setCreationRules();
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
    }

    private function preparePostData()
    {
        $imagePath = $this->image instanceof UploadedFile
            ? '/storage/' . $this->image->store('posts/images', 'public')
            : $this->image;

        $trackPath = $this->track instanceof UploadedFile
            ? '/storage/' . $this->track->store('posts/tracks', 'public')
            : $this->track;

        return [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'body' => $this->body,
            'image' => $imagePath,
            'province' => $this->province,
            'difficulty' => $this->difficulty,
            'longitude' => $this->longitude,
            'altitude' => $this->altitude,
            'duration' => ($this->duration_hours * 60) + $this->duration_minutes,
            'track' => $trackPath,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ];
    }

    public function render()
    {
        return view('livewire.admin.post-list', [
            'posts' => Post::latest()->paginate(10),
        ]);
    }
}
