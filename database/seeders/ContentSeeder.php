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
use App\Models\Booking;
use App\Models\Inquiry;
use App\Models\Subscriber;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedSettings();
        $amenityIds = $this->seedAmenities();
        $this->seedSlides();
        $rooms = $this->seedRooms($amenityIds);
        $this->seedBookings($rooms);
        $this->seedPlaces();
        $this->seedActivities();
        $this->seedServiceValues();
        $this->seedReviews();
        $this->seedArticles();
        $this->seedInquiries();
        $this->seedSubscribers();
    }

    private function seedSettings(): void
    {
        $settings = [
            'site_name'      => 'Ynovee Hotel',
            'contact_email'  => 'info@ynovee.com',
            'contact_phone'  => '+233 55 555 5555',
            'address'        => '123 Beach Road, Ada Foah, Ghana',
            'facebook_url'   => 'https://facebook.com/ynovee',
            'instagram_url'  => 'https://instagram.com/ynovee',
            'twitter_url'    => 'https://twitter.com/ynovee',
            'about_text'     => 'Ynovee Hotel is a luxury beachfront resort nestled on the shores of Ada Foah, Ghana.',
            'check_in_time'  => '14:00',
            'check_out_time' => '11:00',
        ];
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    private function seedAmenities(): array
    {
        $amenities = [
            ['title' => 'Free Wi-Fi',      'icon_url' => 'https://placehold.co/100x100?text=Wifi'],
            ['title' => 'Swimming Pool',   'icon_url' => 'https://placehold.co/100x100?text=Pool'],
            ['title' => 'Gym',             'icon_url' => 'https://placehold.co/100x100?text=Gym'],
            ['title' => 'Spa & Wellness',  'icon_url' => 'https://placehold.co/100x100?text=Spa'],
            ['title' => 'Restaurant',      'icon_url' => 'https://placehold.co/100x100?text=Food'],
            ['title' => 'Free Parking',    'icon_url' => 'https://placehold.co/100x100?text=Car'],
            ['title' => 'Air Conditioning','icon_url' => 'https://placehold.co/100x100?text=AC'],
            ['title' => 'Room Service',    'icon_url' => 'https://placehold.co/100x100?text=Bell'],
            ['title' => 'Private Beach',   'icon_url' => 'https://placehold.co/100x100?text=Beach'],
            ['title' => 'Bar & Lounge',    'icon_url' => 'https://placehold.co/100x100?text=Bar'],
        ];

        $ids = [];
        foreach ($amenities as $data) {
            $ids[] = Amenity::create($data)->id;
        }
        return $ids;
    }

    private function seedSlides(): void
    {
        $slides = [
            [
                'image_url' => 'https://placehold.co/1920x1080?text=Welcome+to+Ynovee',
                'title'     => 'Experience True Luxury',
                'subtitle'  => 'Where the ocean meets elegance — your dream stay awaits',
                'cta_link'  => '/rooms',
            ],
            [
                'image_url' => 'https://placehold.co/1920x1080?text=Ocean+Views',
                'title'     => 'Wake Up to the Ocean',
                'subtitle'  => 'Breathtaking views from every room on the Ada Estuary',
                'cta_link'  => '/rooms',
            ],
            [
                'image_url' => 'https://placehold.co/1920x1080?text=Dining+Experience',
                'title'     => 'World-Class Dining',
                'subtitle'  => 'Savor fresh local cuisine with a stunning waterfront backdrop',
                'cta_link'  => '/contact',
            ],
        ];
        foreach ($slides as $data) {
            Slide::create($data);
        }
    }

    private function seedRooms(array $amenityIds): array
    {
        $rooms = [
            [
                'name'        => 'Standard Room',
                'description' => 'A comfortable and well-appointed standard room with garden view, queen-size bed, en-suite bathroom, and all essential amenities.',
                'capacity'    => 2,
                'price_usd'   => 80.00,
                'price_eur'   => 74.00,
                'price_ghs'   => 1200.00,
                'total_rooms' => 15,
                'amenities'   => array_slice($amenityIds, 0, 5),
                'images'      => [
                    'https://placehold.co/800x600?text=Standard+Room',
                    'https://placehold.co/800x600?text=Standard+Bath',
                ],
            ],
            [
                'name'        => 'Deluxe Ocean View',
                'description' => 'Spacious room with a direct view of the Ada Estuary, king-size bed, private balcony, and premium bath amenities.',
                'capacity'    => 2,
                'price_usd'   => 150.00,
                'price_eur'   => 140.00,
                'price_ghs'   => 2400.00,
                'total_rooms' => 10,
                'amenities'   => array_slice($amenityIds, 0, 7),
                'images'      => [
                    'https://placehold.co/800x600?text=Deluxe+Ocean',
                    'https://placehold.co/800x600?text=Deluxe+Balcony',
                    'https://placehold.co/800x600?text=Deluxe+Bath',
                ],
            ],
            [
                'name'        => 'Family Suite',
                'description' => 'Generous suite with two bedrooms, a living room, kitchenette, and garden terrace. Perfect for families.',
                'capacity'    => 4,
                'price_usd'   => 220.00,
                'price_eur'   => 205.00,
                'price_ghs'   => 3500.00,
                'total_rooms' => 8,
                'amenities'   => array_slice($amenityIds, 0, 8),
                'images'      => [
                    'https://placehold.co/800x600?text=Family+Living',
                    'https://placehold.co/800x600?text=Family+Bedroom',
                ],
            ],
            [
                'name'        => 'Executive Suite',
                'description' => 'Luxurious suite with a separate living area, jacuzzi, ocean views, and dedicated concierge service.',
                'capacity'    => 2,
                'price_usd'   => 300.00,
                'price_eur'   => 280.00,
                'price_ghs'   => 4800.00,
                'total_rooms' => 5,
                'amenities'   => $amenityIds,
                'images'      => [
                    'https://placehold.co/800x600?text=Exec+Suite',
                    'https://placehold.co/800x600?text=Exec+Jacuzzi',
                    'https://placehold.co/800x600?text=Exec+View',
                ],
            ],
            [
                'name'        => 'Presidential Villa',
                'description' => 'The ultimate beachfront villa with a private pool, butler service, full kitchen, and 360° panoramic views.',
                'capacity'    => 6,
                'price_usd'   => 600.00,
                'price_eur'   => 560.00,
                'price_ghs'   => 9500.00,
                'total_rooms' => 2,
                'amenities'   => $amenityIds,
                'images'      => [
                    'https://placehold.co/800x600?text=Villa+Pool',
                    'https://placehold.co/800x600?text=Villa+Living',
                    'https://placehold.co/800x600?text=Villa+View',
                ],
            ],
        ];

        $created = [];
        foreach ($rooms as $data) {
            $created[] = RoomType::create($data);
        }
        return $created;
    }

    private function seedBookings(array $rooms): void
    {
        $bookings = [
            [
                'room_type_id'   => $rooms[0]->id,
                'customer_name'  => 'Alice Johnson',
                'customer_email' => 'alice@example.com',
                'customer_phone' => '+1 202 555 0101',
                'check_in'       => '2025-07-01',
                'check_out'      => '2025-07-05',
                'guests_count'   => 2,
                'currency'       => 'USD',
                'total_price'    => $rooms[0]->price_usd * 4,
                'status'         => 'confirmed',
                'images'         => [],
            ],
            [
                'room_type_id'   => $rooms[1]->id,
                'customer_name'  => 'Kwame Asante',
                'customer_email' => 'kwame@example.com',
                'customer_phone' => '+233 50 123 4567',
                'check_in'       => '2025-07-10',
                'check_out'      => '2025-07-14',
                'guests_count'   => 2,
                'currency'       => 'GHS',
                'total_price'    => $rooms[1]->price_ghs * 4,
                'status'         => 'pending',
                'images'         => [],
            ],
            [
                'room_type_id'   => $rooms[2]->id,
                'customer_name'  => 'Sophie Müller',
                'customer_email' => 'sophie@example.com',
                'customer_phone' => '+49 30 1234567',
                'check_in'       => '2025-07-20',
                'check_out'      => '2025-07-25',
                'guests_count'   => 4,
                'currency'       => 'EUR',
                'total_price'    => $rooms[2]->price_eur * 5,
                'status'         => 'checked_in',
                'images'         => [],
            ],
            [
                'room_type_id'   => $rooms[3]->id,
                'customer_name'  => 'James Osei',
                'customer_email' => 'james@example.com',
                'customer_phone' => '+233 24 987 6543',
                'check_in'       => '2025-06-15',
                'check_out'      => '2025-06-18',
                'guests_count'   => 2,
                'currency'       => 'USD',
                'total_price'    => $rooms[3]->price_usd * 3,
                'status'         => 'checked_out',
                'images'         => [],
            ],
            [
                'room_type_id'   => $rooms[0]->id,
                'customer_name'  => 'Maria Garcia',
                'customer_email' => 'maria@example.com',
                'customer_phone' => '+34 91 555 0022',
                'check_in'       => '2025-08-01',
                'check_out'      => '2025-08-07',
                'guests_count'   => 2,
                'currency'       => 'EUR',
                'total_price'    => $rooms[0]->price_eur * 6,
                'status'         => 'pending',
                'images'         => [],
            ],
            [
                'room_type_id'   => $rooms[1]->id,
                'customer_name'  => 'David Mensah',
                'customer_email' => 'david@example.com',
                'customer_phone' => '+233 57 444 3322',
                'check_in'       => '2025-05-10',
                'check_out'      => '2025-05-12',
                'guests_count'   => 1,
                'currency'       => 'GHS',
                'total_price'    => $rooms[1]->price_ghs * 2,
                'status'         => 'cancelled',
                'images'         => [],
            ],
        ];

        foreach ($bookings as $data) {
            Booking::create($data);
        }
    }

    private function seedPlaces(): void
    {
        $places = [
            [
                'title'       => 'Ada Estuary',
                'location'    => 'Ada Foah, Ghana',
                'description' => 'Where the mighty Volta River meets the Atlantic Ocean, creating a breathtaking natural wonder.',
                'content'     => 'The Ada Estuary is one of Ghana\'s most spectacular natural attractions. The meeting point of the Volta River and the Atlantic Ocean creates a unique ecosystem rich in birdlife and marine biodiversity. Take a boat cruise at sunset for an unforgettable experience.',
                'rating'      => 4.8,
                'image_url'   => 'https://placehold.co/800x600?text=Ada+Estuary',
            ],
            [
                'title'       => 'Laboma Beach',
                'location'    => 'Ada Foah, Ghana',
                'description' => 'A pristine stretch of white sand beach perfect for sunbathing and water sports.',
                'content'     => 'Laboma Beach offers crystal-clear waters and golden sands stretching for miles. Popular activities include swimming, beach volleyball, and sandcastle building. The beach is lined with palm trees offering natural shade.',
                'rating'      => 4.6,
                'image_url'   => 'https://placehold.co/800x600?text=Laboma+Beach',
            ],
            [
                'title'       => 'Volta River Bridge',
                'location'    => 'Ada, Ghana',
                'description' => 'An iconic infrastructure landmark spanning the Volta River with panoramic views.',
                'content'     => 'The Volta River Bridge is not just a transport link but a vantage point for stunning river and delta views. Photographers and tourists flock here for sunrise and sunset shots.',
                'rating'      => 4.2,
                'image_url'   => 'https://placehold.co/800x600?text=Volta+Bridge',
            ],
            [
                'title'       => 'Keta Lagoon',
                'location'    => 'Keta, Volta Region',
                'description' => 'A tranquil lagoon teeming with flamingos, pelicans and other migratory birds.',
                'content'     => 'Keta Lagoon is a Ramsar-listed wetland and one of West Africa\'s most important bird sanctuaries. Bird watching tours depart daily from the hotel.',
                'rating'      => 4.5,
                'image_url'   => 'https://placehold.co/800x600?text=Keta+Lagoon',
            ],
        ];

        foreach ($places as $data) {
            Place::create($data);
        }
    }

    private function seedActivities(): void
    {
        $activities = [
            [
                'title'       => 'Jet Skiing',
                'description' => 'Feel the adrenaline rush as you race across the water on a high-powered jet ski. Suitable for beginners and experienced riders alike.',
                'image_url'   => 'https://placehold.co/800x600?text=Jet+Ski',
            ],
            [
                'title'       => 'Sunset Boat Cruise',
                'description' => 'Glide along the Ada Estuary at sunset on a traditional wooden boat while enjoying drinks and live music.',
                'image_url'   => 'https://placehold.co/800x600?text=Boat+Cruise',
            ],
            [
                'title'       => 'Kayaking',
                'description' => 'Explore the mangroves and estuary channels at your own pace on a guided or self-guided kayaking tour.',
                'image_url'   => 'https://placehold.co/800x600?text=Kayaking',
            ],
            [
                'title'       => 'Beach Volleyball',
                'description' => 'Join a friendly game of beach volleyball on our private beach court. Equipment provided free of charge.',
                'image_url'   => 'https://placehold.co/800x600?text=Volleyball',
            ],
            [
                'title'       => 'Deep Sea Fishing',
                'description' => 'Set out early morning with experienced local fishermen for a deep sea fishing adventure. Catch of the day cooked by our chefs.',
                'image_url'   => 'https://placehold.co/800x600?text=Fishing',
            ],
            [
                'title'       => 'Cultural Village Tour',
                'description' => 'Visit local Ada fishing communities, learn about traditional fishing techniques, and experience authentic Ghanaian hospitality.',
                'image_url'   => 'https://placehold.co/800x600?text=Village+Tour',
            ],
        ];

        foreach ($activities as $data) {
            Activity::create($data);
        }
    }

    private function seedServiceValues(): void
    {
        $values = [
            [
                'title'       => 'Excellence',
                'description' => 'We hold ourselves to the highest standards, ensuring every detail of your stay exceeds expectations.',
                'icon_url'    => 'https://placehold.co/100x100?text=Star',
            ],
            [
                'title'       => 'Integrity',
                'description' => 'Honest, transparent service is at the core of everything we do — from pricing to guest relations.',
                'icon_url'    => 'https://placehold.co/100x100?text=Shield',
            ],
            [
                'title'       => 'Warmth',
                'description' => 'Our team treats every guest like family, delivering heartfelt hospitality rooted in Ghanaian culture.',
                'icon_url'    => 'https://placehold.co/100x100?text=Heart',
            ],
            [
                'title'       => 'Sustainability',
                'description' => 'We are committed to protecting the Ada Estuary ecosystem for future generations through eco-friendly practices.',
                'icon_url'    => 'https://placehold.co/100x100?text=Leaf',
            ],
        ];

        foreach ($values as $data) {
            ServiceValue::create($data);
        }
    }

    private function seedReviews(): void
    {
        $reviews = [
            [
                'name'      => 'Alice Johnson',
                'role'      => 'Business Traveler',
                'feedback'  => 'Absolutely stunning resort. The ocean view room was worth every penny. The staff were incredibly attentive and the food was exceptional.',
                'rating'    => 5,
                'image_url' => 'https://placehold.co/100x100?text=Alice',
            ],
            [
                'name'      => 'Kwame Asante',
                'role'      => 'Family Vacationer',
                'feedback'  => 'Brought my family here for the holidays. The kids loved the pool and the beach activities. We will definitely be back next year!',
                'rating'    => 5,
                'image_url' => 'https://placehold.co/100x100?text=Kwame',
            ],
            [
                'name'      => 'Sophie Müller',
                'role'      => 'Honeymoon Guest',
                'feedback'  => 'A magical place for a honeymoon. The sunset boat cruise was unforgettable and the suite was beautifully decorated.',
                'rating'    => 5,
                'image_url' => 'https://placehold.co/100x100?text=Sophie',
            ],
            [
                'name'      => 'David Mensah',
                'role'      => 'Weekend Traveler',
                'feedback'  => 'Great value for money. The standard room was clean and comfortable. The jet skiing activity was a highlight.',
                'rating'    => 4,
                'image_url' => 'https://placehold.co/100x100?text=David',
            ],
            [
                'name'      => 'Maria Garcia',
                'role'      => 'Solo Traveler',
                'feedback'  => 'I loved the peaceful atmosphere. The cultural village tour was an eye-opener and the staff were so welcoming.',
                'rating'    => 4,
                'image_url' => 'https://placehold.co/100x100?text=Maria',
            ],
        ];

        foreach ($reviews as $data) {
            Review::create($data);
        }
    }

    private function seedArticles(): void
    {
        $articles = [
            [
                'title'        => 'Top 10 Things to Do in Ada Foah',
                'author'       => 'Ynovee Team',
                'category'     => 'Travel',
                'content'      => '<p>Ada Foah is one of Ghana\'s best kept secrets. From the stunning estuary to lively beach bars, there is something for everyone. Here are our top 10 picks for your visit...</p><p>1. Sunset boat cruise on the Volta Estuary<br>2. Jet skiing at Laboma Beach<br>3. Kayaking through the mangroves<br>4. Deep sea fishing at dawn<br>5. Cultural tour of Ada fishing villages...</p>',
                'image_url'    => 'https://placehold.co/800x600?text=Ada+Guide',
                'published_at' => '2025-01-15 09:00:00',
            ],
            [
                'title'        => 'A Foodie\'s Guide to Ghanaian Coastal Cuisine',
                'author'       => 'Chef Emmanuel Tetteh',
                'category'     => 'Food',
                'content'      => '<p>Ghana\'s coastline offers some of the most vibrant and flavourful dishes in West Africa. From fresh grilled tilapia to kontomire stew, the coastal kitchen is a treasure trove for food lovers...</p>',
                'image_url'    => 'https://placehold.co/800x600?text=Ghanaian+Food',
                'published_at' => '2025-02-20 10:00:00',
            ],
            [
                'title'        => 'Why Ada Foah Is the Ultimate Romantic Getaway',
                'author'       => 'Ynovee Team',
                'category'     => 'Travel',
                'content'      => '<p>Couples from across the globe are discovering Ada Foah as the perfect destination for romance. The tranquil estuary, world-class spa treatments, and candlelit beachfront dinners make it truly special...</p>',
                'image_url'    => 'https://placehold.co/800x600?text=Romance',
                'published_at' => '2025-03-10 08:30:00',
            ],
            [
                'title'        => 'Sustainable Tourism at Ynovee: Our Green Commitment',
                'author'       => 'Ynovee Management',
                'category'     => 'Sustainability',
                'content'      => '<p>At Ynovee, we believe luxury and environmental responsibility go hand in hand. Learn how we are reducing our carbon footprint and supporting local conservation efforts at the Ada Estuary...</p>',
                'image_url'    => 'https://placehold.co/800x600?text=Eco+Resort',
                'published_at' => '2025-04-05 11:00:00',
            ],
        ];

        foreach ($articles as $data) {
            Article::create($data);
        }
    }

    private function seedInquiries(): void
    {
        $inquiries = [
            [
                'name'    => 'Robert Agyemang',
                'email'   => 'robert@example.com',
                'message' => 'Hi, I would like to enquire about hosting a corporate retreat for 30 people in November. Do you have conference facilities?',
            ],
            [
                'name'    => 'Claudia Bianchi',
                'email'   => 'claudia@example.com',
                'message' => 'We are planning a destination wedding in December. Could you provide information about event packages and capacity?',
            ],
            [
                'name'    => 'Yaw Darko',
                'email'   => 'yaw@example.com',
                'message' => 'What is the earliest check-in time available? We are arriving on an early morning flight.',
            ],
        ];

        foreach ($inquiries as $data) {
            Inquiry::create($data);
        }
    }

    private function seedSubscribers(): void
    {
        $emails = [
            'newsletter1@example.com',
            'newsletter2@example.com',
            'newsletter3@example.com',
            'travel_lover@example.com',
            'ghana_explorer@example.com',
        ];

        foreach ($emails as $email) {
            Subscriber::updateOrCreate(['email' => $email]);
        }
    }
}
