<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\RoomType;
use App\Models\Activity;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase; // Use in-memory DB or reset

    public function test_booking_creation_with_multiple_images()
    {
        Storage::fake('public');

        $roomType = RoomType::create([
            'name' => 'Deluxe Suite',
            'description' => 'A nice room',
            'capacity' => 2,
            'price_usd' => 100,
            'price_eur' => 90,
            'price_ghs' => 1200,
            'total_rooms' => 5,
            'images' => [],
        ]);

        $file1 = UploadedFile::fake()->image('room1.jpg');
        $file2 = UploadedFile::fake()->image('room2.jpg');

        $response = $this->postJson('/api/bookings', [
            'room_type_id' => $roomType->id,
            'check_in' => now()->addDays(1)->format('Y-m-d'),
            'check_out' => now()->addDays(3)->format('Y-m-d'),
            'guests' => 2,
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'customer_phone' => '1234567890',
            'currency' => 'USD',
            'images' => [$file1, $file2],
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['images']);
        $this->assertCount(2, $response->json('images'));

        // Assert files were stored
        $images = $response->json('images');
        // Extract filename from URL to check storage
        // URL format: http://localhost/storage/bookings/filename
        
        foreach ($images as $url) {
            $parsed = parse_url($url);
            $path = ltrim($parsed['path'], '/storage'); // This might depend on symlink config
            // Simplified check: just check if files exist in the directory
            // Storage::fake puts them in storage/framework/testing/... so assertExists works on the relative path
            
            // Actually, we stored as 'public/bookings/filename'.
            // Storage::disk('public')->assertExists(...) checks relative to the disk root.
            
            $basename = basename($url);
            Storage::disk('public')->assertExists('bookings/' . $basename);
        }
    }

    public function test_user_can_upload_avatar()
    {
        Storage::fake('public');
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson('/api/auth/profile', [
            'avatar' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['avatar']);
        
        $avatarUrl = $response->json('avatar');
        $this->assertNotNull($avatarUrl);
        
        $basename = basename($avatarUrl);
        Storage::disk('public')->assertExists('avatars/' . $basename);
    }

    public function test_admin_can_upload_activity_image()
    {
        Storage::fake('public');
        
        $user = User::factory()->create();
        // Assuming there isn't strict "Admin" role check in middleware yet, just auth:sanctum
        // If there is, we might need to set role. 
        // Based on routes: Route::middleware('auth:sanctum')->group(...) includes admin routes.
        
        $this->actingAs($user);

        $file = UploadedFile::fake()->image('activity.jpg');

        $response = $this->postJson('/api/activities', [
            'title' => 'Surfing',
            'description' => 'Fun in the sun',
            'image' => $file,
        ]);

        $response->assertStatus(201);
        
        $activity = Activity::first();
        $this->assertNotNull($activity->image_url);
        
        $basename = basename($activity->image_url);
        Storage::disk('public')->assertExists('activities/' . $basename);
    }
}
