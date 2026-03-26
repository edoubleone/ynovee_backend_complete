<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Article;
use App\Models\Place;
use App\Models\Review;
use App\Models\ServiceValue;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUploadUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_slide_image_can_be_updated_without_resending_other_fields(): void
    {
        $slide = Slide::create([
            'title' => 'Hero',
            'subtitle' => 'Initial subtitle',
            'image_url' => 'https://example.com/old-slide.jpg',
        ]);

        $response = $this->post('/api/slides/'.$slide->id, [
            'image' => UploadedFile::fake()->image('slide.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('slides/' . basename($response->json('image_url')));
    }

    public function test_activity_image_can_be_updated_without_resending_other_fields(): void
    {
        $activity = Activity::create([
            'title' => 'Surfing',
            'description' => 'Initial description',
            'image_url' => 'https://example.com/old-activity.jpg',
        ]);

        $response = $this->post('/api/activities/'.$activity->id, [
            'image' => UploadedFile::fake()->image('activity.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('activities/' . basename($response->json('image_url')));
    }

    public function test_article_image_can_be_updated_without_resending_other_fields(): void
    {
        $article = Article::create([
            'title' => 'News',
            'author' => 'Editor',
            'category' => 'General',
            'content' => 'Initial content',
            'image_url' => 'https://example.com/old-article.jpg',
            'published_at' => now(),
        ]);

        $response = $this->post('/api/articles/'.$article->id, [
            'image' => UploadedFile::fake()->image('article.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('articles/' . basename($response->json('image_url')));
    }

    public function test_amenity_icon_can_be_updated_without_resending_other_fields(): void
    {
        $amenity = Amenity::create([
            'title' => 'WiFi',
            'icon_url' => 'https://example.com/old-icon.jpg',
        ]);

        $response = $this->post('/api/amenities/'.$amenity->id, [
            'icon' => UploadedFile::fake()->image('amenity.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('amenities/' . basename($response->json('icon_url')));
    }

    public function test_place_image_can_be_updated_without_resending_other_fields(): void
    {
        $place = Place::create([
            'title' => 'Beach',
            'location' => 'Coast',
            'description' => 'Initial description',
            'image_url' => 'https://example.com/old-place.jpg',
        ]);

        $response = $this->post('/api/places/'.$place->id, [
            'image' => UploadedFile::fake()->image('place.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('places/' . basename($response->json('image_url')));
    }

    public function test_review_image_can_be_updated_without_resending_other_fields(): void
    {
        $review = Review::create([
            'name' => 'John',
            'feedback' => 'Great stay',
            'rating' => 5,
            'image_url' => 'https://example.com/old-review.jpg',
        ]);

        $response = $this->post('/api/reviews/'.$review->id, [
            'image' => UploadedFile::fake()->image('review.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('reviews/' . basename($response->json('image_url')));
    }

    public function test_service_value_icon_can_be_updated_without_resending_other_fields(): void
    {
        $serviceValue = ServiceValue::create([
            'title' => 'Quality',
            'description' => 'Initial description',
            'icon_url' => 'https://example.com/old-service.jpg',
        ]);

        $response = $this->post('/api/service-values/'.$serviceValue->id, [
            'icon' => UploadedFile::fake()->image('service.jpg'),
        ]);

        $response->assertOk();
        Storage::disk('public')->assertExists('service-values/' . basename($response->json('icon_url')));
    }
}
