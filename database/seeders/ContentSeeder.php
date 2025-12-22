<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\Amenity;
use App\Models\RoomType;
use App\Models\Place;
use App\Models\Activity;
use App\Models\ServiceValue;
use App\Models\Review;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // 1. Settings
        $settings = [
            'site_name' => 'Ynovee Hotel',
            'contact_email' => 'info@ynovee.com',
            'contact_phone' => '+233 55 555 5555',
            'address' => '123 Beach Road, Ada Foah, Ghana',
            'facebook_url' => 'https://facebook.com/ynovee',
            'instagram_url' => 'https://instagram.com/ynovee',
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 2. Amenities
        $amenities = [
            ['title' => 'Free Wi-Fi', 'icon_url' => 'https://placehold.co/100x100?text=Wifi'],
            ['title' => 'Swimming Pool', 'icon_url' => 'https://placehold.co/100x100?text=Pool'],
            ['title' => 'Gym', 'icon_url' => 'https://placehold.co/100x100?text=Gym'],
            ['title' => 'Spa', 'icon_url' => 'https://placehold.co/100x100?text=Spa'],
            ['title' => 'Restaurant', 'icon_url' => 'https://placehold.co/100x100?text=Food'],
            ['title' => 'Parking', 'icon_url' => 'https://placehold.co/100x100?text=Car'],
        ];
        
        $amenityIds = [];
        foreach ($amenities as $data) {
            $amenity = Amenity::create($data);
            $amenityIds[] = $amenity->id;
        }

        // 3. Slides (Hero)
        Slide::create([
            'image_url' => 'https://placehold.co/1920x1080?text=Welcome+to+Ynovee',
            'title' => 'Experience lUxury',
            'subtitle' => 'The best place to relax',
            'cta_link' => '/rooms'
        ]);
        Slide::create([
            'image_url' => 'https://placehold.co/1920x1080?text=Ocean+View',
            'title' => 'Wake up to the Ocean',
            'subtitle' => 'Breathtaking views from every room',
            'cta_link' => '/contact'
        ]);

        // 4. Room Types
        RoomType::create([
            'name' => 'Deluxe Ocean View',
            'description' => 'A spacious room with a direct view of the ocean, king size bed, and private balcony.',
            'capacity' => 2,
            'price_usd' => 150.00,
            'price_eur' => 140.00,
            'price_ghs' => 2400.00,
            'total_rooms' => 10,
            'amenities' => $amenityIds, // Attach all amenities
            'images' => [
                'https://placehold.co/800x600?text=Deluxe+Room+1', 
                'https://placehold.co/800x600?text=Deluxe+Bath'
            ]
        ]);

        RoomType::create([
            'name' => 'Executive Suite',
            'description' => 'Luxury suite with separate living area, jacuzzi, and premium amenities.',
            'capacity' => 4,
            'price_usd' => 300.00,
            'price_eur' => 280.00,
            'price_ghs' => 4800.00,
            'total_rooms' => 5,
            'amenities' => $amenityIds,
            'images' => [
                'https://placehold.co/800x600?text=Suite+Living', 
                'https://placehold.co/800x600?text=Suite+Bed'
            ]
        ]);

        // 5. Places (Attractions)
        Place::create([
            'title' => 'Ada Estuary',
            'location' => 'Ada Foah',
            'description' => 'Where the river meets the sea.',
            'content' => 'A beautiful natural wonder perfect for boat rides and bird watching.',
            'rating' => 4.8,
            'image_url' => 'https://placehold.co/800x600?text=Estuary'
        ]);

        // 6. Activities
        Activity::create([
            'title' => 'Jet Skiing',
            'description' => 'Adrenaline pumping action on the water.',
            'image_url' => 'https://placehold.co/800x600?text=Jet+Ski'
        ]);

        // 7. Service Values
        ServiceValue::create([
            'title' => 'Excellence',
            'description' => 'We strive for perfection in everything we do.',
            'icon_url' => 'https://placehold.co/100x100?text=Star'
        ]);
        
        // 8. Reviews
        Review::create([
            'name' => 'John Doe',
            'role' => 'Business Traveler',
            'feedback' => 'Amazing stay, the wifi was fast and the food was great.',
            'rating' => 5,
            'image_url' => 'https://placehold.co/100x100?text=John'
        ]);

        // 9. Articles
        Article::create([
            'title' => 'Top 10 Things to do in Ada',
            'author' => 'Ynovee Team',
            'category' => 'Travel',
            'content' => 'Ada is full of surprises...',
            'image_url' => 'https://placehold.co/800x600?text=Blog+Post',
            'published_at' => now()
        ]);
    }
}
