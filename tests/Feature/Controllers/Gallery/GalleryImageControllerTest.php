<?php

use App\Models\User;
use App\Models\GalleryImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\delete;

test('an authenticated user can upload an image', function () {

    Storage::fake('public');

    $user = User::factory()->create();
    actingAs($user);

    $response = post(route('gallery.store'), [
        'title' => 'Test image',
        'image' => UploadedFile::fake()->image('test.jpg'),
    ]);

    $response->assertRedirect(route('gallery.index'));

    expect(Storage::disk('public')->allFiles('images'))->not->toBeEmpty();

    $image = GalleryImage::first();

    $this->assertNotNull($image);
    $this->assertEquals('pending', $image->status);
});

test('user can delete an image', function () {

    $user = User::factory()->create();
    $image = GalleryImage::factory()->create(['user_id' => $user->id]);
    actingAs($user);

    $response = delete(route('gallery.destroy', $image));

    $response->assertRedirect(route('gallery.user-images'));
    expect(GalleryImage::find($image->id))->toBeNull();
});

test('user can view their uploaded images', function () {

    $user = User::factory()->create();
    GalleryImage::factory()->count(2)->create(['user_id' => $user->id]);
    actingAs($user);

    get(route('gallery.user-images'))
        ->assertOk()
        ->assertViewIs('gallery.user-images')
        ->assertViewHas('images');
});
