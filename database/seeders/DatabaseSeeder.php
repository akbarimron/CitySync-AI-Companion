<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ChatHistory;
use App\Models\ChatSession;
use App\Models\CrowdMetrics;
use App\Models\Destination;
use App\Models\IotDevice;
use App\Models\User;
use App\Models\UserPreference;
use App\Models\WeatherReference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Weather Reference Data (Kondisi Cuaca)
        $weatherConditions = [
            ['condition_name' => 'Sunny', 'icon_code' => 'SUN01', 'security_level' => 1],
            ['condition_name' => 'Cloudy', 'icon_code' => 'CLD02', 'security_level' => 2],
            ['condition_name' => 'Rainy', 'icon_code' => 'RNY03', 'security_level' => 3],
            ['condition_name' => 'Stormy', 'icon_code' => 'STM04', 'security_level' => 4],
            ['condition_name' => 'Snowy', 'icon_code' => 'SNW05', 'security_level' => 3],
            ['condition_name' => 'Foggy', 'icon_code' => 'FOG06', 'security_level' => 4],
        ];
        
        foreach ($weatherConditions as $condition) {
            WeatherReference::create($condition);
        }
        
        echo "✓ Weather Reference data seeded\n";

        // 2. Create Categories (Kategori Destinasi)
        $categories = [
            ['name' => 'Pantai'],
            ['name' => 'Gunung'],
            ['name' => 'Budaya'],
            ['name' => 'Hiburan'],
            ['name' => 'Kuliner'],
        ];
        
        foreach ($categories as $category) {
            Category::create($category);
        }
        
        echo "✓ Categories seeded\n";

        // 3. Create Destinations (Destinasi Wisata)
        $destinations = [
            [
                'category_id' => 1,
                'name' => 'Pantai Kuta',
                'latitude' => -8.7245,
                'longitude' => 115.1723,
                'description' => 'Pantai yang terkenal dengan pasir putih dan ombak yang bagus untuk selancar.',
                'base_price' => 50000,
            ],
            [
                'category_id' => 1,
                'name' => 'Pantai Sanur',
                'latitude' => -8.7207,
                'longitude' => 115.2628,
                'description' => 'Pantai yang tenang dengan pemandangan matahari terbit yang indah.',
                'base_price' => 45000,
            ],
            [
                'category_id' => 2,
                'name' => 'Gunung Bromo',
                'latitude' => -7.9422,
                'longitude' => 112.9545,
                'description' => 'Gunung berapi aktif dengan pemandangan spektakuler.',
                'base_price' => 150000,
            ],
            [
                'category_id' => 3,
                'name' => 'Borobudur',
                'latitude' => -7.6074,
                'longitude' => 110.2038,
                'description' => 'Candi Buddha terbesar di dunia dengan arsitektur yang menakjubkan.',
                'base_price' => 75000,
            ],
            [
                'category_id' => 5,
                'name' => 'Pasar Malam Minggu',
                'latitude' => -6.2088,
                'longitude' => 106.8000,
                'description' => 'Pasar tradisional dengan berbagai kuliner lokal yang lezat.',
                'base_price' => 20000,
            ],
        ];
        
        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
        
        echo "✓ Destinations seeded\n";

        // 4. Create Users (Pengguna)
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@citysync.local',
                'password' => 'password123',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Alice Williams',
                'email' => 'alice@example.com',
                'password' => 'password123',
            ],
        ];
        
        foreach ($users as $user) {
            User::create($user);
        }
        
        echo "✓ Users seeded\n";

        // 5. Create User Preferences (Preferensi Pengguna)
        $userIds = User::pluck('id')->all();
        $categoryIds = Category::pluck('id')->all();
        
        foreach ($userIds as $userId) {
            // Setiap user mendapat 2-3 preferensi kategori acak
            $randomCategories = collect($categoryIds)->random(rand(2, 3))->toArray();
            
            foreach ($randomCategories as $categoryId) {
                UserPreference::create([
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                    'interest_score' => rand(50, 100) / 10,
                ]);
            }
        }
        
        echo "✓ User Preferences seeded\n";

        // 6. Create IoT Devices (Perangkat IoT di Destinasi)
        $destinationIds = Destination::pluck('id')->all();
        $deviceTypes = ['Camera', 'Weather_Station', 'GPS_Tracker'];
        
        foreach ($destinationIds as $destinationId) {
            // Setiap destinasi mendapat 2-4 perangkat IoT
            $deviceCount = rand(2, 4);
            for ($i = 0; $i < $deviceCount; $i++) {
                IotDevice::create([
                    'destination_id' => $destinationId,
                    'device_type' => $deviceTypes[array_rand($deviceTypes)],
                    'stream_url' => 'http://camera-stream-' . uniqid() . '.local/stream',
                    'is_active' => rand(0, 1) ? true : false,
                ]);
            }
        }
        
        echo "✓ IoT Devices seeded\n";

        // 7. Create Chat Sessions (Sesi Chat)
        $chatSessions = ChatSession::factory(10)
            ->for(User::inRandomOrder()->first())
            ->create();
        
        echo "✓ Chat Sessions seeded\n";

        // 8. Create Chat History (Riwayat Chat)
        foreach ($chatSessions as $session) {
            ChatHistory::factory(rand(3, 8))
                ->for($session, 'chatSession')
                ->create();
        }
        
        echo "✓ Chat History seeded\n";

        // 9. Create Crowd Metrics (Metrik Keramaian)
        $iotDevices = IotDevice::all();
        $weatherIds = WeatherReference::pluck('id')->all();
        
        foreach ($iotDevices as $device) {
            // Setiap perangkat mendapat 5-15 data metrik keramaian
            $metricsCount = rand(5, 15);
            for ($i = 0; $i < $metricsCount; $i++) {
                CrowdMetrics::create([
                    'device_id' => $device->id,
                    'timestamp' => now()->subDays(rand(0, 7))->addHours(rand(0, 23)),
                    'occupancy_count' => rand(10, 500),
                    'weather_id' => $weatherIds[array_rand($weatherIds)],
                ]);
            }
        }
        
        echo "✓ Crowd Metrics seeded\n";

        echo "\n✓ All seeding completed successfully!\n";
    }
}
