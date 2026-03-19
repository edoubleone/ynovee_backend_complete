<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Amenity;
use App\Models\Article;
use App\Models\Place;
use App\Models\Review;
use App\Models\RoomType;
use App\Models\ServiceValue;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdditionalImageUploadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_amenity_upload()
    {
        $file = UploadedFile::fake()->image('icon.png');
        $response = $this->postJson('/api/amenities', [
            'title' => 'WiFi',
            'icon' => $file,
        ]);

        $response->assertStatus(201);
        $this->assertNotNull($response->json('icon_url'));
        Storage::disk('public')->assertExists('amenities/' . basename($response->json('icon_url')));
    }

    public function test_article_upload()
    {
        $file = UploadedFile::fake()->image('article.jpg');
        $response = $this->postJson('/api/articles', [
            'title' => 'News',
            'author' => 'Editor',
            'category' => 'General',
            'content' => 'Some content',
            'published_at' => now()->format('Y-m-d'),
            'image' => $file,
        ]);

        $response->assertStatus(201);
        $this->assertNotNull($response->json('image_url'));
        Storage::disk('public')->assertExists('articles/' . basename($response->json('image_url')));
    }

    public function test_place_upload()
    {
        $file = UploadedFile::fake()->image('place.jpg');
        $response = $this->postJson('/api/places', [
            'title' => 'Beach',
            'location' => 'Coast',
            'description' => 'Nice beach',
            'image' => $file,
        ]);

        $response->assertStatus(201);
        $this->assertNotNull($response->json('image_url'));
        Storage::disk('public')->assertExists('places/' . basename($response->json('image_url')));
    }

    public function test_review_upload()
    {
        $file = UploadedFile::fake()->image('reviewer.jpg');
        $response = $this->postJson('/api/reviews', [
            'name' => 'John',
            'feedback' => 'Great!',
            'rating' => 5,
            'image' => $file,
        ]);

        $response->assertStatus(201);
        $this->assertNotNull($response->json('image_url'));
        Storage::disk('public')->assertExists('reviews/' . basename($response->json('image_url')));
    }

    public function test_service_value_upload()
    {
        $file = UploadedFile::fake()->image('service.png');
        $response = $this->postJson('/api/service-values', [
            'title' => 'Quality',
            'description' => 'Top notch',
            'icon' => $file,
        ]);

        $response->assertStatus(201);
        $this->assertNotNull($response->json('icon_url'));
        Storage::disk('public')->assertExists('service-values/' . basename($response->json('icon_url')));
    }

    public function test_room_upload()
    {
        $file1 = UploadedFile::fake()->image('room1.jpg');
        $file2 = UploadedFile::fake()->image('room2.jpg');

        $response = $this->postJson('/api/rooms', [
            'name' => 'Suite',
            'description' => 'Luxury',
            'capacity' => 2,
            'price_usd' => 100,
            'price_eur' => 90,
            'price_ghs' => 1000,
            'total_rooms' => 5,
            'images' => [$file1, $file2],
        ]);

        $response->assertStatus(201);
        $images = $response->json('images');
        $this->assertCount(2, $images);
        
        foreach ($images as $url) {
            Storage::disk('public')->assertExists('rooms/' . basename($url));
        }
    }
}
