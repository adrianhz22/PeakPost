<?php

use App\Models\GalleryImage;
use App\Models\User;
use Spatie\Permission\Models\Role;

test('moderator can view pending images list', function () {

    Role::firstOrCreate(['name' => 'moderator']);
    $user = User::factory()->create()->assignRole('moderator');

    GalleryImage::factory()->count(5)->create(['status' => 'pending']);

    $this->actingAs($user)
        ->get(route('moderation.pending-images'))
        ->assertStatus(200)
        ->assertViewIs('moderation.pending-images')
        ->assertViewHas('images');
});

test('moderator can reject an image with reason', function () {

    Role::firstOrCreate(['name' => 'moderator']);
    $user = User::factory()->create()->assignRole('moderator');

    $image = GalleryImage::factory()->create(['status' => 'pending']);

    $response = $this->actingAs($user)
        ->patch(route('moderation.images.reject', $image), [
            'rejection_reason' => 'No cumple con las normas',
        ]);

    $response->assertRedirect(route('moderation.pending-images'));

    $this->assertDatabaseHas('gallery_images', [
        'id' => $image->id,
        'status' => 'rejected',
        'rejection_reason' => 'No cumple con las normas',
    ]);
});

test('rejecting an image requires a rejection_reason', function () {

    Role::firstOrCreate(['name' => 'moderator']);
    $user = User::factory()->create()->assignRole('moderator');

    $image = GalleryImage::factory()->create(['status' => 'pending']);

    $response = $this->actingAs($user)
        ->patch(route('moderation.images.reject', $image), [
            'rejection_reason' => '',
        ]);

    $response->assertSessionHasErrors('rejection_reason');
});
