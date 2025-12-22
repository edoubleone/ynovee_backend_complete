<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StandardizedUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_standardized_image_uploads()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $this->actingAs($user);

        // Slide (image)
        $respSlide = $this->postJson('/api/slides', [
            'title' => 'T', 'subtitle' => 'S', 
            'image' => UploadedFile::fake()->image('slide.jpg')
        ]);
        $respSlide->assertStatus(201);
        $this->assertNotNull($respSlide->json('image_url'));

        // Slide (optional subtitle)
        $respSlideOptional = $this->postJson('/api/slides', [
            'title' => 'T',
            'image' => UploadedFile::fake()->image('slide2.jpg')
        ]);
        $respSlideOptional->assertStatus(201);

        // Article (image)
        $respArticle = $this->postJson('/api/articles', [
            'title' => 'T', 'author' => 'A', 'category' => 'C', 'content' => 'Content', 'published_at' => now(),
            'image' => UploadedFile::fake()->image('article.jpg')
        ]);
        $respArticle->assertStatus(201);

        // Activity (image)
        $respActivity = $this->postJson('/api/activities', [
            'title' => 'T', 'description' => 'D',
            'image' => UploadedFile::fake()->image('activity.jpg')
        ]);
        $respActivity->assertStatus(201);

        // Place (image)
        $respPlace = $this->postJson('/api/places', [
            'title' => 'T', 'location' => 'L', 'description' => 'D',
            'image' => UploadedFile::fake()->image('place.jpg')
        ]);
        $respPlace->assertStatus(201);

        // Review (image) - uses image input but maps to image_url
        $respReview = $this->postJson('/api/reviews', [
            'name' => 'N', 'feedback' => 'F', 'rating' => 5,
            'image' => UploadedFile::fake()->image('review.jpg')
        ]);
        $respReview->assertStatus(201);
    }

    public function test_standardized_icon_uploads()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $this->actingAs($user);

        // Amenity (icon)
        $respAmenity = $this->postJson('/api/amenities', [
            'title' => 'Wifi',
            'icon' => UploadedFile::fake()->image('icon1.jpg')
        ]);
        $respAmenity->assertStatus(201);
        $this->assertNotNull($respAmenity->json('icon_url'));

        // ServiceValue (icon)
        $respServiceValue = $this->postJson('/api/service-values', [
            'title' => 'T', 'description' => 'D',
            'icon' => UploadedFile::fake()->image('icon2.jpg')
        ]);
        $respServiceValue->assertStatus(201);
    }
}
