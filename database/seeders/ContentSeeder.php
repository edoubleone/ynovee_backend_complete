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
use App\Models\Tour;
use App\Models\TourBooking;

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
        $tours = $this->seedTours();
        $this->seedTourBookings($tours);
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
            ['title' => 'Free Wi-Fi',      'icon_url' => '/images/page_1_img_4.jpeg'],
            ['title' => 'Swimming Pool',   'icon_url' => '/images/page_1_img_5.jpeg'],
            ['title' => 'Gym',             'icon_url' => '/images/page_1_img_6.jpeg'],
            ['title' => 'Spa & Wellness',  'icon_url' => '/images/page_1_img_7.jpeg'],
            ['title' => 'Restaurant',      'icon_url' => '/images/page_1_img_2.jpeg'],
            ['title' => 'Free Parking',    'icon_url' => '/images/page_1_img_4.jpeg'],
            ['title' => 'Air Conditioning','icon_url' => '/images/page_1_img_2.jpeg'],
            ['title' => 'Room Service',    'icon_url' => '/images/page_1_img_7.jpeg'],
            ['title' => 'Private Beach',   'icon_url' => '/images/page_1_img_5.jpeg'],
            ['title' => 'Bar & Lounge',    'icon_url' => '/images/page_1_img_8.jpeg'],
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
                'image_url' => '/images/page_6_img_6.jpeg',
                'title'     => 'Experience True Luxury',
                'subtitle'  => 'Where the ocean meets elegance — your dream stay awaits',
                'cta_link'  => '/rooms',
            ],
            [
                'image_url' => '/images/page_6_img_17.jpeg',
                'title'     => 'Wake Up to the Ocean',
                'subtitle'  => 'Breathtaking views from every room on the Ada Estuary',
                'cta_link'  => '/rooms',
            ],
            [
                'image_url' => '/images/page_6_img_26.jpeg',
                'title'     => 'Unforgettable Moments',
                'subtitle'  => 'Savor the magic of starlit evenings on the waterfront',
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
                    '/images/page_6_img_44.jpeg',
                    '/images/page_5_img_1.jpeg',
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
                    '/images/page_6_img_17.jpeg',
                    '/images/page_1_img_1.jpeg',
                    '/images/page_6_img_31.jpeg',
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
                    '/images/page_6_img_6.jpeg',
                    '/images/page_6_img_29.jpeg',
                    '/images/page_6_img_44.jpeg',
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
                    '/images/page_6_img_17.jpeg',
                    '/images/page_6_img_26.jpeg',
                    '/images/page_5_img_1.jpeg',
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
                    '/images/page_6_img_6.jpeg',
                    '/images/page_6_img_17.jpeg',
                    '/images/page_6_img_1.jpeg',
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
                'image_url'   => '/images/page_1_img_1.jpeg',
            ],
            [
                'title'       => 'Laboma Beach',
                'location'    => 'Ada Foah, Ghana',
                'description' => 'A pristine stretch of white sand beach perfect for sunbathing and water sports.',
                'content'     => 'Laboma Beach offers crystal-clear waters and golden sands stretching for miles. Popular activities include swimming, beach volleyball, and sandcastle building. The beach is lined with palm trees offering natural shade.',
                'rating'      => 4.6,
                'image_url'   => '/images/page_6_img_44.jpeg',
            ],
            [
                'title'       => 'Volta River Bridge',
                'location'    => 'Ada, Ghana',
                'description' => 'An iconic infrastructure landmark spanning the Volta River with panoramic views.',
                'content'     => 'The Volta River Bridge is not just a transport link but a vantage point for stunning river and delta views. Photographers and tourists flock here for sunrise and sunset shots.',
                'rating'      => 4.2,
                'image_url'   => '/images/page_6_img_4.jpeg',
            ],
            [
                'title'       => 'Keta Lagoon',
                'location'    => 'Keta, Volta Region',
                'description' => 'A tranquil lagoon teeming with flamingos, pelicans and other migratory birds.',
                'content'     => 'Keta Lagoon is a Ramsar-listed wetland and one of West Africa\'s most important bird sanctuaries. Bird watching tours depart daily from the hotel.',
                'rating'      => 4.5,
                'image_url'   => '/images/page_6_img_30.jpeg',
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
                'image_url'   => '/images/page_6_img_1.jpeg',
            ],
            [
                'title'       => 'Sunset Boat Cruise',
                'description' => 'Glide along the Ada Estuary at sunset on a traditional wooden boat while enjoying drinks and live music.',
                'image_url'   => '/images/page_6_img_26.jpeg',
            ],
            [
                'title'       => 'Kayaking',
                'description' => 'Explore the mangroves and estuary channels at your own pace on a guided or self-guided kayaking tour.',
                'image_url'   => '/images/page_5_img_1.jpeg',
            ],
            [
                'title'       => 'Beach Volleyball',
                'description' => 'Join a friendly game of beach volleyball on our private beach court. Equipment provided free of charge.',
                'image_url'   => '/images/page_6_img_44.jpeg',
            ],
            [
                'title'       => 'Deep Sea Fishing',
                'description' => 'Set out early morning with experienced local fishermen for a deep sea fishing adventure. Catch of the day cooked by our chefs.',
                'image_url'   => '/images/page_1_img_9.jpeg',
            ],
            [
                'title'       => 'Cultural Village Tour',
                'description' => 'Visit local Ada fishing communities, learn about traditional fishing techniques, and experience authentic Ghanaian hospitality.',
                'image_url'   => '/images/page_2_img_1.jpeg',
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
                'icon_url'    => '/images/page_6_img_7.jpeg',
            ],
            [
                'title'       => 'Integrity',
                'description' => 'Honest, transparent service is at the core of everything we do — from pricing to guest relations.',
                'icon_url'    => '/images/page_6_img_9.jpeg',
            ],
            [
                'title'       => 'Warmth',
                'description' => 'Our team treats every guest like family, delivering heartfelt hospitality rooted in Ghanaian culture.',
                'icon_url'    => '/images/page_6_img_48.jpeg',
            ],
            [
                'title'       => 'Sustainability',
                'description' => 'We are committed to protecting the Ada Estuary ecosystem for future generations through eco-friendly practices.',
                'icon_url'    => '/images/page_6_img_30.jpeg',
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
                'image_url' => '/images/page_6_img_45.jpeg',
            ],
            [
                'name'      => 'Kwame Asante',
                'role'      => 'Family Vacationer',
                'feedback'  => 'Brought my family here for the holidays. The kids loved the pool and the beach activities. We will definitely be back next year!',
                'rating'    => 5,
                'image_url' => '/images/page_6_img_2.jpeg',
            ],
            [
                'name'      => 'Sophie Müller',
                'role'      => 'Honeymoon Guest',
                'feedback'  => 'A magical place for a honeymoon. The sunset boat cruise was unforgettable and the suite was beautifully decorated.',
                'rating'    => 5,
                'image_url' => '/images/page_6_img_3.jpeg',
            ],
            [
                'name'      => 'David Mensah',
                'role'      => 'Weekend Traveler',
                'feedback'  => 'Great value for money. The standard room was clean and comfortable. The jet skiing activity was a highlight.',
                'rating'    => 4,
                'image_url' => '/images/page_6_img_45.jpeg',
            ],
            [
                'name'      => 'Maria Garcia',
                'role'      => 'Solo Traveler',
                'feedback'  => 'I loved the peaceful atmosphere. The cultural village tour was an eye-opener and the staff were so welcoming.',
                'rating'    => 4,
                'image_url' => '/images/page_6_img_1.jpeg',
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
                'image_url'    => '/images/page_6_img_31.jpeg',
                'published_at' => '2025-01-15 09:00:00',
            ],
            [
                'title'        => 'A Foodie\'s Guide to Ghanaian Coastal Cuisine',
                'author'       => 'Chef Emmanuel Tetteh',
                'category'     => 'Food',
                'content'      => '<p>Ghana\'s coastline offers some of the most vibrant and flavourful dishes in West Africa. From fresh grilled tilapia to kontomire stew, the coastal kitchen is a treasure trove for food lovers...</p>',
                'image_url'    => '/images/page_6_img_48.jpeg',
                'published_at' => '2025-02-20 10:00:00',
            ],
            [
                'title'        => 'Why Ada Foah Is the Ultimate Romantic Getaway',
                'author'       => 'Ynovee Team',
                'category'     => 'Travel',
                'content'      => '<p>Couples from across the globe are discovering Ada Foah as the perfect destination for romance. The tranquil estuary, world-class spa treatments, and candlelit beachfront dinners make it truly special...</p>',
                'image_url'    => '/images/page_6_img_26.jpeg',
                'published_at' => '2025-03-10 08:30:00',
            ],
            [
                'title'        => 'Sustainable Tourism at Ynovee: Our Green Commitment',
                'author'       => 'Ynovee Management',
                'category'     => 'Sustainability',
                'content'      => '<p>At Ynovee, we believe luxury and environmental responsibility go hand in hand. Learn how we are reducing our carbon footprint and supporting local conservation efforts at the Ada Estuary...</p>',
                'image_url'    => '/images/page_6_img_9.jpeg',
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

    private function seedTours(): array
    {
        $tours = [
            [
                'title'       => 'Ada Estuary Sunset Cruise',
                'description' => 'Glide along the magical Ada Estuary at golden hour aboard a traditional wooden boat. Watch the sun sink into the Volta River while enjoying chilled drinks and live highlife music. One of the most iconic experiences on the Ghanaian coast.',
                'location'    => 'Ada Foah, Ghana',
                'duration'    => '3 hours',
                'price_usd'   => 45.00,
                'price_eur'   => 42.00,
                'price_ghs'   => 650.00,
                'max_guests'  => 12,
                'category'    => 'Nature',
                'inclusions'  => ['Boat ride', 'Welcome drink', 'Live music', 'Life jackets', 'Professional guide'],
                'exclusions'  => ['Personal insurance', 'Additional beverages', 'Gratuities'],
                'images'      => [
                    '/images/page_6_img_31.jpeg',
                    '/images/page_6_img_26.jpeg',
                ],
                'is_featured' => true,
                'status'      => 'active',
            ],
            [
                'title'       => 'Accra City Heritage Walk',
                'description' => 'Explore the vibrant heart of Accra on a guided heritage walk through Jamestown, the National Museum, and Makola Market. Discover colonial-era landmarks, street art, and the sounds and smells of an authentic West African capital city.',
                'location'    => 'Accra, Ghana',
                'duration'    => '5 hours',
                'price_usd'   => 35.00,
                'price_eur'   => 32.00,
                'price_ghs'   => 500.00,
                'max_guests'  => 15,
                'category'    => 'Culture',
                'inclusions'  => ['Expert local guide', 'Museum entry fees', 'Traditional snack tasting', 'Hotel pickup'],
                'exclusions'  => ['Lunch', 'Personal shopping', 'Tips'],
                'images'      => [
                    '/images/page_1_img_12.jpeg',
                    '/images/page_6_img_7.jpeg',
                ],
                'is_featured' => true,
                'status'      => 'active',
            ],
            [
                'title'       => 'Kakum Canopy Walk Adventure',
                'description' => 'Walk above the rainforest canopy on a series of hanging bridges suspended 30 metres above the jungle floor in Kakum National Park. Spot rare birds, butterflies, and lush tropical flora on this thrilling eco-adventure.',
                'location'    => 'Kakum National Park, Cape Coast',
                'duration'    => 'Full Day (8 hours)',
                'price_usd'   => 75.00,
                'price_eur'   => 70.00,
                'price_ghs'   => 1100.00,
                'max_guests'  => 10,
                'category'    => 'Adventure',
                'inclusions'  => ['Round-trip transport from Ada', 'Park entry fee', 'Canopy walk fee', 'Packed lunch', 'Ranger-guided nature walk'],
                'exclusions'  => ['Personal travel insurance', 'Souvenirs', 'Additional meals'],
                'images'      => [
                    '/images/page_3_img_1.jpeg',
                    '/images/page_6_img_2.jpeg',
                ],
                'is_featured' => true,
                'status'      => 'active',
            ],
            [
                'title'       => 'Cape Coast Castle & Slave Route',
                'description' => 'A deeply moving and historically significant journey through Cape Coast Castle and the Door of No Return — a UNESCO World Heritage Site. Led by a knowledgeable historian, this tour honours the legacy of the transatlantic slave trade.',
                'location'    => 'Cape Coast, Ghana',
                'duration'    => 'Full Day (9 hours)',
                'price_usd'   => 65.00,
                'price_eur'   => 60.00,
                'price_ghs'   => 950.00,
                'max_guests'  => 20,
                'category'    => 'Culture',
                'inclusions'  => ['Transport from Ada', 'Castle entry & guided tour', 'Historian commentary', 'Lunch at local restaurant'],
                'exclusions'  => ['Personal purchases', 'Additional snacks', 'Tips'],
                'images'      => [
                    '/images/page_1_img_10.jpeg',
                    '/images/page_6_img_8.jpeg',
                ],
                'is_featured' => false,
                'status'      => 'active',
            ],
            [
                'title'       => 'Mangrove Kayaking Expedition',
                'description' => 'Paddle through the enchanting mangrove forests bordering the Ada Estuary on a guided kayaking expedition. Spot kingfishers, monitor lizards, and unique mangrove flora on this peaceful, immersive nature experience.',
                'location'    => 'Ada Foah, Ghana',
                'duration'    => '2.5 hours',
                'price_usd'   => 30.00,
                'price_eur'   => 28.00,
                'price_ghs'   => 430.00,
                'max_guests'  => 8,
                'category'    => 'Adventure',
                'inclusions'  => ['Kayak and paddle', 'Life jacket', 'Waterproof bag', 'Expert nature guide'],
                'exclusions'  => ['Swimming gear', 'Sunscreen', 'Personal valuables'],
                'images'      => [
                    '/images/page_5_img_1.jpeg',
                    '/images/page_6_img_31.jpeg',
                ],
                'is_featured' => false,
                'status'      => 'active',
            ],
            [
                'title'       => 'Volta Region Hot Springs & Waterfalls',
                'description' => 'Escape to the lush Volta Region to soak in natural hot springs and hike to the spectacular Wli Waterfalls — the highest waterfall in West Africa. A perfect blend of relaxation and natural wonder.',
                'location'    => 'Volta Region, Ghana',
                'duration'    => 'Full Day (10 hours)',
                'price_usd'   => 85.00,
                'price_eur'   => 79.00,
                'price_ghs'   => 1250.00,
                'max_guests'  => 12,
                'category'    => 'Nature',
                'inclusions'  => ['Air-conditioned transport', 'Waterfall entry', 'Hot springs access', 'Packed lunch & refreshments', 'Hiking guide'],
                'exclusions'  => ['Personal travel insurance', 'Swimwear', 'Towels', 'Tips'],
                'images'      => [
                    '/images/page_6_img_30.jpeg',
                    '/images/page_6_img_4.jpeg',
                ],
                'is_featured' => true,
                'status'      => 'active',
            ],
            [
                'title'       => 'Spa & Wellness Retreat Day',
                'description' => 'Indulge in a full day of pampering at our on-site spa. Choose from a menu of treatments including deep-tissue massage, traditional shea butter body wrap, and reflexology, followed by a healthy gourmet lunch by the pool.',
                'location'    => 'Ynovee Hotel, Ada Foah',
                'duration'    => '6 hours',
                'price_usd'   => 120.00,
                'price_eur'   => 112.00,
                'price_ghs'   => 1800.00,
                'max_guests'  => 4,
                'category'    => 'Relaxation',
                'inclusions'  => ['60-min massage', 'Body wrap treatment', 'Reflexology session', 'Healthy gourmet lunch', 'Use of pool & steam room'],
                'exclusions'  => ['Additional spa treatments', 'Gratuities', 'External transport'],
                'images'      => [
                    '/images/page_6_img_17.jpeg',
                    '/images/page_6_img_26.jpeg',
                ],
                'is_featured' => false,
                'status'      => 'active',
            ],
        ];

        $created = [];
        foreach ($tours as $data) {
            $created[] = Tour::create($data);
        }
        return $created;
    }

    private function seedTourBookings(array $tours): void
    {
        $bookings = [
            [
                'tour'           => $tours[0], // Ada Estuary Sunset Cruise
                'booking_date'   => '2026-04-15',
                'guests_count'   => 2,
                'customer_name'  => 'Alice Johnson',
                'customer_email' => 'alice@example.com',
                'customer_phone' => '+1 202 555 0101',
                'currency'       => 'USD',
                'status'         => 'confirmed',
            ],
            [
                'tour'           => $tours[0],
                'booking_date'   => '2026-04-20',
                'guests_count'   => 4,
                'customer_name'  => 'Kwame Asante',
                'customer_email' => 'kwame@example.com',
                'customer_phone' => '+233 50 123 4567',
                'currency'       => 'GHS',
                'status'         => 'confirmed',
            ],
            [
                'tour'           => $tours[1], // Accra City Heritage Walk
                'booking_date'   => '2026-04-18',
                'guests_count'   => 3,
                'customer_name'  => 'Sophie Müller',
                'customer_email' => 'sophie@example.com',
                'customer_phone' => '+49 30 1234567',
                'currency'       => 'EUR',
                'status'         => 'pending',
            ],
            [
                'tour'           => $tours[2], // Kakum Canopy Walk
                'booking_date'   => '2026-05-02',
                'guests_count'   => 2,
                'customer_name'  => 'James Osei',
                'customer_email' => 'james@example.com',
                'customer_phone' => '+233 24 987 6543',
                'currency'       => 'USD',
                'status'         => 'confirmed',
            ],
            [
                'tour'           => $tours[4], // Mangrove Kayaking
                'booking_date'   => '2026-04-25',
                'guests_count'   => 2,
                'customer_name'  => 'Maria Garcia',
                'customer_email' => 'maria@example.com',
                'customer_phone' => '+34 91 555 0022',
                'currency'       => 'EUR',
                'status'         => 'pending',
            ],
        ];

        foreach ($bookings as $data) {
            $tour = $data['tour'];
            $pricePerGuest = match ($data['currency']) {
                'EUR'   => $tour->price_eur,
                'GHS'   => $tour->price_ghs,
                default => $tour->price_usd,
            };

            TourBooking::create([
                'tour_id'        => $tour->id,
                'booking_date'   => $data['booking_date'],
                'guests_count'   => $data['guests_count'],
                'customer_name'  => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'total_price'    => $pricePerGuest * $data['guests_count'],
                'currency'       => $data['currency'],
                'status'         => $data['status'],
            ]);
        }
    }
}
