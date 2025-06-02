<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    User::factory()->count(1)->create();
});

test('shows message when no old rejected posts exist', function () {
    Post::factory()->count(5)->create([
        'status' => 'rejected',
        'created_at' => now()->subMonths(1),
        'user_id' => User::factory()->create()->id,
    ]);

    $this->artisan('posts:delete-old-rejected')
        ->expectsOutput('There are no old rejected posts to delete.')
        ->assertExitCode(0);

    expect(Post::count())->toBe(5);
});

test('deletes old rejected posts and associated files', function () {

    Storage::fake('public');

    $user = User::factory()->create();

    Post::factory()->count(3)->create([
        'status' => 'rejected',
        'created_at' => now()->subMonths(4),
        'user_id' => $user->id,
        'image' => 'posts/image.jpg',
        'track' => 'tracks/track.kml',
    ]);

    Storage::disk('public')->put('posts/image.jpg', '');
    Storage::disk('public')->put('tracks/track.kml', '');

    $this->artisan('posts:delete-old-rejected')
        ->expectsOutput('3 rejected posts older than 3 months were deleted.')
        ->assertExitCode(0);

    expect(Post::where('status', 'rejected')->count())->toBe(0);

    Storage::disk('public')->assertMissing('posts/test-image.jpg');
    Storage::disk('public')->assertMissing('tracks/test-track.kml');
});
