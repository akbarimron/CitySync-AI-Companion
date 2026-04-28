<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CrowdMetrics;
use App\Models\Destination;
use App\Models\Feature;
use App\Models\IotDevice;
use App\Models\User;
use App\Models\UserPreference;
use App\Models\WeatherReference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach ([
            'crowd_metrics',
            'iot_devices',
            'user_preferences',
            'destinations',
            'features',
            'categories',
            'weather_reference',
            'users',
        ] as $table) {
            DB::table($table)->truncate();
        }

        Schema::enableForeignKeyConstraints();

        $demoVideoUrl = 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4';

        // 1. Create Weather Reference Data (Kondisi Cuaca)
        $weatherConditions = [
            ['condition_name' => 'Cerah', 'icon_code' => 'SUN01', 'security_level' => 1],
            ['condition_name' => 'Cerah Berawan', 'icon_code' => 'CLD02', 'security_level' => 2],
            ['condition_name' => 'Mendung', 'icon_code' => 'CLD03', 'security_level' => 2],
            ['condition_name' => 'Hujan Ringan', 'icon_code' => 'RNY03', 'security_level' => 3],
            ['condition_name' => 'Berangin', 'icon_code' => 'WND04', 'security_level' => 2],
        ];
        
        foreach ($weatherConditions as $condition) {
            WeatherReference::updateOrCreate(
                ['condition_name' => $condition['condition_name']],
                $condition
            );
        }

        // 2. Create Categories (Kategori Destinasi)
        $categories = [
            ['name' => 'Budaya'],
            ['name' => 'Alam'],
            ['name' => 'Modern'],
            ['name' => 'Hiburan'],
            ['name' => 'Kuliner'],
        ];
        
        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

        $categoryIds = Category::pluck('id', 'name');

        // 3. Create SQL-backed feature cards for the home + feature page
        $features = [
            [
                'slug' => 'contextual-ai-assistant',
                'name' => 'Contextual AI Assistant',
                'description' => 'GPT-4 Powered Travel Guide untuk routing dan rekomendasi yang disesuaikan dengan preferensi pengguna.',
                'icon_key' => 'assistant',
                'accent_color' => 'cyan',
                'sort_order' => 1,
            ],
            [
                'slug' => 'proactive-crowd-optimizer',
                'name' => 'Proactive Crowd Optimizer',
                'description' => 'Analisis keramaian prediktif untuk membantu pengguna memilih waktu kunjungan terbaik sebelum berangkat.',
                'icon_key' => 'crowd',
                'accent_color' => 'emerald',
                'sort_order' => 2,
            ],
            [
                'slug' => 'immersive-real-time-preview',
                'name' => 'Immersive Real-Time Preview',
                'description' => 'Preview 360 street view dan demo video agar wisatawan bisa melihat kondisi lokasi sebelum datang.',
                'icon_key' => 'preview',
                'accent_color' => 'teal',
                'sort_order' => 3,
            ],
            [
                'slug' => 'smart-booking-dynamic-pricing',
                'name' => 'Smart Booking & Dynamic Pricing',
                'description' => 'Booking tiket demo dengan alur yang rapi dan harga yang bisa disesuaikan berdasarkan demand.',
                'icon_key' => 'booking',
                'accent_color' => 'blue',
                'sort_order' => 4,
            ],
            [
                'slug' => 'unified-payment-access',
                'name' => 'Unified Payment & Access',
                'description' => 'Akses digital yang aman dan terintegrasi untuk pengalaman wisata yang lebih seamless.',
                'icon_key' => 'access',
                'accent_color' => 'violet',
                'sort_order' => 5,
            ],
        ];

        foreach ($features as $feature) {
            Feature::updateOrCreate(
                ['slug' => $feature['slug']],
                $feature + ['is_active' => true]
            );
        }

        // 4. Create Destinations (Destinasi Wisata)
        $destinations = [
            [
                'slug' => 'kota-tua-jakarta',
                'category' => 'Budaya',
                'name' => 'Kota Tua Jakarta',
                'latitude' => -6.1344,
                'longitude' => 106.8065,
                'description' => 'Jelajahi sejarah Jakarta melalui bangunan bersejarah dan arsitektur kolonial yang megah.',
                'base_price' => 75000,
                'is_featured' => true,
                'featured_rank' => 1,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1570129477492-45a003537e90?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.1344,106.8065&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jl. Pintu Besar Utara, Kota Tua, Jakarta Barat',
                    'area' => 'Jakarta Barat',
                    'rating' => 4.5,
                    'crowd_percentage' => 52,
                    'weather' => '28°C · Cerah',
                    'opening_hours' => '08:00 - 17:00 WIB',
                    'best_time' => 'Pagi hari',
                    'tip' => 'Paling nyaman untuk walking tour dan eksplor museum.',
                    'visitors' => '2,450',
                    'confidence' => 92,
                    'preview_copy' => 'Preview 360 untuk area Kota Tua yang bersejarah dan walkable.',
                ],
            ],
            [
                'slug' => 'taman-mini-indonesia-indah',
                'category' => 'Budaya',
                'name' => 'Taman Mini Indonesia Indah',
                'latitude' => -6.2961,
                'longitude' => 106.8941,
                'description' => 'Taman tematik dengan miniatur berbagai budaya Indonesia di satu tempat.',
                'base_price' => 100000,
                'is_featured' => true,
                'featured_rank' => 2,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.2961,106.8941&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Taman Mini Indonesia Indah, Jakarta Timur',
                    'area' => 'Jakarta Timur',
                    'rating' => 4.3,
                    'crowd_percentage' => 38,
                    'weather' => '27°C · Mendung',
                    'opening_hours' => '08:00 - 17:00 WIB',
                    'best_time' => 'Pagi sampai siang',
                    'tip' => 'Cocok untuk itinerary keluarga seharian.',
                    'visitors' => '1,900',
                    'confidence' => 89,
                    'preview_copy' => 'Preview 360 untuk kawasan budaya yang luas dan nyaman untuk keluarga.',
                ],
            ],
            [
                'slug' => 'jakarta-aquarium',
                'category' => 'Hiburan',
                'name' => 'Jakarta Aquarium',
                'latitude' => -6.1752,
                'longitude' => 106.8249,
                'description' => 'Akuarium besar dengan pengalaman indoor yang nyaman dan interaktif.',
                'base_price' => 120000,
                'is_featured' => true,
                'featured_rank' => 3,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.1752,106.8249&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jakarta Aquarium & Safari, Jakarta Barat',
                    'area' => 'Jakarta Barat',
                    'rating' => 4.6,
                    'crowd_percentage' => 85,
                    'weather' => '29°C · Cerah',
                    'opening_hours' => '10:00 - 21:00 WIB',
                    'best_time' => 'Sore hari',
                    'tip' => 'Datang lebih awal untuk menghindari antrean panjang.',
                    'visitors' => '3,100',
                    'confidence' => 90,
                    'preview_copy' => 'Demo preview untuk area indoor yang cocok saat cuaca kurang bersahabat.',
                ],
            ],
            [
                'slug' => 'monumen-nasional',
                'category' => 'Budaya',
                'name' => 'Monumen Nasional',
                'latitude' => -6.1751,
                'longitude' => 106.8270,
                'description' => 'Monumen ikonik Indonesia yang mewakili kemerdekaan dan persatuan.',
                'base_price' => 50000,
                'is_featured' => true,
                'featured_rank' => 4,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1512207736139-e8c07a4b0a8e?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.1751,106.8270&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Gambir, Jakarta Pusat',
                    'area' => 'Jakarta Pusat',
                    'rating' => 4.4,
                    'crowd_percentage' => 61,
                    'weather' => '28°C · Cerah',
                    'opening_hours' => '08:00 - 16:00 WIB',
                    'best_time' => 'Pagi hari',
                    'tip' => 'Gunakan sepatu nyaman karena area eksplor cukup luas.',
                    'visitors' => '4,200',
                    'confidence' => 91,
                    'preview_copy' => 'Preview lokasi Monas yang ikonik dan dekat pusat kota.',
                ],
            ],
            [
                'slug' => 'ancol-waterfront',
                'category' => 'Alam',
                'name' => 'Ancol Waterfront',
                'latitude' => -6.1220,
                'longitude' => 106.8300,
                'description' => 'Area waterfront untuk keluarga, sunset walk, dan bundling transport menuju destinasi sekitar Ancol.',
                'base_price' => 45000,
                'is_featured' => true,
                'featured_rank' => 5,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.1220,106.8300&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jl. Lodan Timur, Ancol, Jakarta Utara',
                    'area' => 'Jakarta Utara',
                    'rating' => 4.4,
                    'crowd_percentage' => 44,
                    'weather' => '29°C · Cerah',
                    'opening_hours' => '08:00 - 22:00 WIB',
                    'best_time' => 'Sore hari',
                    'tip' => 'Cocok untuk menikmati sunset dan area tepi air.',
                    'visitors' => '2,200',
                    'confidence' => 88,
                    'preview_copy' => 'Preview tepi laut yang cocok untuk family escape dan evening walk.',
                ],
            ],
            [
                'slug' => 'museum-nasional-indonesia',
                'category' => 'Budaya',
                'name' => 'Museum Nasional Indonesia',
                'latitude' => -6.1925,
                'longitude' => 106.8235,
                'description' => 'Museum terbesar di Asia Tenggara dengan koleksi arkeologi dan etnografi lengkap.',
                'base_price' => 30000,
                'is_featured' => false,
                'featured_rank' => 6,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1564399579883-451a5ddf9c51?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.1925,106.8235&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jl. Medan Merdeka Barat, Jakarta Pusat',
                    'area' => 'Jakarta Pusat',
                    'rating' => 4.4,
                    'crowd_percentage' => 45,
                    'weather' => '28°C · Cerah',
                    'opening_hours' => '08:00 - 16:00 WIB',
                    'best_time' => 'Pagi sampai siang',
                    'tip' => 'Bagus untuk wisata edukasi singkat.',
                    'visitors' => '2,000',
                    'confidence' => 87,
                    'preview_copy' => 'Preview edukatif untuk museum yang nyaman dijelajahi.',
                ],
            ],
            [
                'slug' => 'kepulauan-seribu',
                'category' => 'Alam',
                'name' => 'Kepulauan Seribu',
                'latitude' => -5.9910,
                'longitude' => 106.6019,
                'description' => 'Kepulauan dengan pantai pasir putih dan air laut yang jernih.',
                'base_price' => 250000,
                'is_featured' => false,
                'featured_rank' => 7,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-5.9910,106.6019&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Kepulauan Seribu, Jakarta',
                    'area' => 'Kepulauan Seribu',
                    'rating' => 4.7,
                    'crowd_percentage' => 32,
                    'weather' => '30°C · Cerah',
                    'opening_hours' => 'Fleksibel sesuai paket perjalanan',
                    'best_time' => 'Musim cuaca cerah',
                    'tip' => 'Periksa jadwal kapal sebelum berangkat.',
                    'visitors' => '1,200',
                    'confidence' => 85,
                    'preview_copy' => 'Preview laut lepas untuk wisata bahari dan island hopping.',
                ],
            ],
            [
                'slug' => 'taman-lansekap-nasional',
                'category' => 'Alam',
                'name' => 'Taman Lansekap Nasional',
                'latitude' => -6.2744,
                'longitude' => 106.8057,
                'description' => 'Taman dengan koleksi tanaman langka dan pemandangan alam yang indah.',
                'base_price' => 40000,
                'is_featured' => false,
                'featured_rank' => 8,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1469090217138-fab0db261e75?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.2744,106.8057&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jakarta Selatan, DKI Jakarta',
                    'area' => 'Jakarta Selatan',
                    'rating' => 4.3,
                    'crowd_percentage' => 24,
                    'weather' => '27°C · Mendung',
                    'opening_hours' => '07:00 - 17:00 WIB',
                    'best_time' => 'Pagi hari',
                    'tip' => 'Pilih jam pagi agar suasana lebih sejuk.',
                    'visitors' => '1,000',
                    'confidence' => 83,
                    'preview_copy' => 'Preview hijau dan tenang untuk healing singkat.',
                ],
            ],
            [
                'slug' => 'grand-indonesia-shopping-center',
                'category' => 'Modern',
                'name' => 'Grand Indonesia Shopping Center',
                'latitude' => -6.1970,
                'longitude' => 106.8218,
                'description' => 'Pusat perbelanjaan premium dengan brand internasional dan fasilitas lengkap.',
                'base_price' => 0,
                'is_featured' => false,
                'featured_rank' => 9,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1555636222-cff0eb3f5e14?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.1970,106.8218&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jl. M.H. Thamrin, Jakarta Pusat',
                    'area' => 'Jakarta Pusat',
                    'rating' => 4.4,
                    'crowd_percentage' => 90,
                    'weather' => '29°C · Cerah',
                    'opening_hours' => '10:00 - 22:00 WIB',
                    'best_time' => 'Siang atau malam',
                    'tip' => 'Bagus untuk city stroll dan makan malam.',
                    'visitors' => '4,800',
                    'confidence' => 88,
                    'preview_copy' => 'Preview urban modern untuk belanja dan kuliner.',
                ],
            ],
            [
                'slug' => 'pulau-tidung',
                'category' => 'Alam',
                'name' => 'Pulau Tidung',
                'latitude' => -5.8800,
                'longitude' => 106.6000,
                'description' => 'Pulau dengan pantai indah, air jernih, dan aktivitas water sports yang seru.',
                'base_price' => 200000,
                'is_featured' => false,
                'featured_rank' => 10,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-5.8800,106.6000&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Pulau Tidung, Kepulauan Seribu',
                    'area' => 'Kepulauan Seribu',
                    'rating' => 4.6,
                    'crowd_percentage' => 28,
                    'weather' => '30°C · Cerah',
                    'opening_hours' => 'Fleksibel sesuai paket perjalanan',
                    'best_time' => 'Musim cerah',
                    'tip' => 'Cocok untuk weekend escape dan snorkeling.',
                    'visitors' => '1,500',
                    'confidence' => 86,
                    'preview_copy' => 'Preview pulau tropis untuk liburan singkat dari Jakarta.',
                ],
            ],
            [
                'slug' => 'senayan-city',
                'category' => 'Modern',
                'name' => 'Senayan City',
                'latitude' => -6.2267,
                'longitude' => 106.7899,
                'description' => 'Mal modern dengan berbagai restoran, kafe, dan toko fashion.',
                'base_price' => 0,
                'is_featured' => false,
                'featured_rank' => 11,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1555636222-cff0eb3f5e14?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.2267,106.7899&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Jl. Asia Afrika, Gelora, Jakarta Selatan',
                    'area' => 'Jakarta Selatan',
                    'rating' => 4.3,
                    'crowd_percentage' => 68,
                    'weather' => '28°C · Cerah',
                    'opening_hours' => '10:00 - 22:00 WIB',
                    'best_time' => 'Sore hari',
                    'tip' => 'Pas untuk belanja santai dan nongkrong.',
                    'visitors' => '3,200',
                    'confidence' => 84,
                    'preview_copy' => 'Preview urban lifestyle untuk belanja dan hangout.',
                ],
            ],
            [
                'slug' => 'dufan-ancol',
                'category' => 'Hiburan',
                'name' => 'Dunia Fantasi (DUFAN)',
                'latitude' => -6.2557,
                'longitude' => 106.8195,
                'description' => 'Taman hiburan terbesar di Indonesia dengan wahana seru untuk seluruh keluarga.',
                'base_price' => 180000,
                'is_featured' => false,
                'featured_rank' => 12,
                'metadata' => [
                    'image_url' => 'https://images.unsplash.com/photo-1540932239986-310128078ceb?w=1400&h=900&fit=crop',
                    'street_view_url' => 'https://www.google.com/maps?q=&layer=c&cbll=-6.2557,106.8195&cbp=11,0,0,0,0',
                    'demo_video_url' => $demoVideoUrl,
                    'address' => 'Dunia Fantasi, Ancol, Jakarta Utara',
                    'area' => 'Jakarta Utara',
                    'rating' => 4.6,
                    'crowd_percentage' => 88,
                    'weather' => '28°C · Cerah',
                    'opening_hours' => '10:00 - 20:00 WIB',
                    'best_time' => 'Sore menjelang malam',
                    'tip' => 'Gunakan AI monitor untuk melihat jam paling lengang.',
                    'visitors' => '3,500',
                    'confidence' => 90,
                    'preview_copy' => 'Preview wahana hiburan yang seru untuk keluarga.',
                ],
            ],
        ];
        
        foreach ($destinations as $destination) {
            Destination::updateOrCreate(
                ['slug' => $destination['slug']],
                [
                    'category_id' => $categoryIds[$destination['category']],
                    'name' => $destination['name'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                    'description' => $destination['description'],
                    'base_price' => $destination['base_price'],
                    'is_featured' => $destination['is_featured'],
                    'featured_rank' => $destination['featured_rank'],
                    'metadata' => $destination['metadata'],
                ]
            );
        }

        $destinationModels = Destination::query()->with('category')->orderBy('featured_rank')->get();

        // 5. Create IoT devices for each destination (camera feed demo)
        foreach ($destinationModels as $destination) {
            $camera = IotDevice::updateOrCreate(
                [
                    'destination_id' => $destination->id,
                    'device_type' => 'Camera',
                ],
                [
                    'stream_url' => $destination->demo_video_url,
                    'is_active' => true,
                ]
            );

            IotDevice::updateOrCreate(
                [
                    'destination_id' => $destination->id,
                    'device_type' => 'Weather_Station',
                ],
                [
                    'stream_url' => 'weather://'.$destination->slug,
                    'is_active' => true,
                ]
            );

            // 6. Create sample crowd metrics for the camera feed
            $weatherId = WeatherReference::query()
                ->where('condition_name', collect(['Cerah', 'Cerah Berawan', 'Mendung', 'Hujan Ringan'])->random())
                ->value('id');

            for ($i = 0; $i < 3; $i++) {
                CrowdMetrics::create([
                    'device_id' => $camera->id,
                    'timestamp' => now()->subHours($i * 2),
                    'occupancy_count' => max(10, (int) round(($destination->display_crowd ?: 45) * 25 + ($i * 8))),
                    'weather_id' => $weatherId,
                ]);
            }
        }

        // 7. Seed a few users and preferences for personalization surfaces
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@citysync.local'],
            ['name' => 'Traveler Satu', 'email' => 'traveler1@citysync.local'],
            ['name' => 'Traveler Dua', 'email' => 'traveler2@citysync.local'],
        ];

        foreach ($users as $index => $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password123'),
                ]
            );

            $preferredCategories = Category::query()->orderBy('name')->take(3)->get();
            foreach ($preferredCategories as $category) {
                UserPreference::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'category_id' => $category->id,
                    ],
                    [
                        'interest_score' => 8 + $index,
                    ]
                );
            }
        }

        // Keep the console output short so repeated seed runs stay readable.
        $this->command?->info('Seeded CitySync Jakarta tourism data successfully.');
    }
}
