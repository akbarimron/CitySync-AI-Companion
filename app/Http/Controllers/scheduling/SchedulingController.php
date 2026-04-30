<?php

namespace App\Http\Controllers\Scheduling;

use App\Http\Controllers\Controller;
use App\Services\DistanceMatrixService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SchedulingController extends Controller
{
    protected $distanceMatrixService;

    public function __construct(DistanceMatrixService $distanceMatrixService)
    {
        $this->distanceMatrixService = $distanceMatrixService;
    }

    /**
     * Tampilkan halaman scheduling
     */
    public function index()
    {
        return view('scheduling.itinerary');
    }

    /**
     * Buat jadwal optimal berdasarkan input user
     */
    public function createSchedule(Request $request)
    {
        $validated = $request->validate([
            'current_address' => 'required|string|min:3',
            'destination_address' => 'required|string|min:3',
            'departure_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required|date_format:H:i',
            'transit_type' => 'required|in:bus,train,subway,tram,car,plane',
            'avoid_tolls' => 'boolean',
            'fastest_route' => 'boolean',
            'avoid_crowds' => 'boolean'
        ]);

        try {
            // 1. Geocode lokasi awal
            $originGeocode = $this->distanceMatrixService->geocodeAddress($validated['current_address']);

            if (!$originGeocode) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alamat awal tidak ditemukan. Gunakan alamat yang lebih spesifik (contoh: Jalan Dago No. 1, Bandung)'
                ], 400);
            }

            // 2. Geocode lokasi tujuan
            $destGeocode = $this->distanceMatrixService->geocodeAddress($validated['destination_address']);

            if (!$destGeocode) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alamat tujuan tidak ditemukan. Gunakan alamat yang lebih spesifik'
                ], 400);
            }

            // 3. Parse departure time
            $departureDateTime = Carbon::parse($validated['departure_date'] . ' ' . $validated['departure_time']);
            $departureTimestamp = $departureDateTime->timestamp;

            // 4. Hitung distance matrix
            $distanceData = $this->distanceMatrixService->calculateDistance(
                ['lat' => $originGeocode['latitude'], 'lng' => $originGeocode['longitude']],
                ['lat' => $destGeocode['latitude'], 'lng' => $destGeocode['longitude']],
                $validated['transit_type'],
                [
                    'departure_time' => $departureTimestamp,
                    'avoid_tolls' => $validated['avoid_tolls'] ?? false
                ]
            );

            if (!$distanceData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghitung rute untuk mode transportasi ini. Coba mode lain.'
                ], 400);
            }

            // 5. Estimasi biaya
            $distanceInKm = $distanceData['distance']['value'] / 1000;
            $costEstimate = $this->distanceMatrixService->estimateCost($distanceInKm, $validated['transit_type']);

            // 6. Generate route steps dengan detail
            $steps = $this->generateDetailedRouteSteps(
                $originGeocode,
                $destGeocode,
                $distanceData,
                $validated['transit_type'],
                $departureDateTime
            );

            // 7. Prediksi crowd level
            $crowdLevel = $this->predictCrowdLevel($departureDateTime);

            // 8. Hitung estimasi waktu tiba
            $estimatedArrival = $departureDateTime->copy()->addSeconds($distanceData['duration']['value']);

            // 9. Generate route polyline points untuk peta
            $routePoints = $this->generateRoutePoints(
                $originGeocode['latitude'],
                $originGeocode['longitude'],
                $destGeocode['latitude'],
                $destGeocode['longitude']
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'origin' => [
                        'address' => $originGeocode['formatted_address'],
                        'coordinates' => [
                            'lat' => $originGeocode['latitude'],
                            'lng' => $originGeocode['longitude']
                        ]
                    ],
                    'destination' => [
                        'address' => $destGeocode['formatted_address'],
                        'coordinates' => [
                            'lat' => $destGeocode['latitude'],
                            'lng' => $destGeocode['longitude']
                        ]
                    ],
                    'summary' => [
                        'distance' => $distanceData['distance']['text'],
                        'distance_value' => $distanceData['distance']['value'],
                        'duration' => $distanceData['duration']['text'],
                        'duration_value' => $distanceData['duration']['value'],
                        'cost' => $costEstimate['formatted'],
                        'cost_value' => $costEstimate['cost'],
                        'crowd_level' => $crowdLevel,
                        'transit_mode' => $this->getTransitLabel($validated['transit_type']),
                        'transit_mode_value' => $validated['transit_type']
                    ],
                    'schedule' => [
                        'departure_time' => $departureDateTime->format('H:i'),
                        'departure_date' => $departureDateTime->format('d M Y'),
                        'estimated_arrival' => $estimatedArrival->format('H:i'),
                        'estimated_arrival_full' => $estimatedArrival->format('d M Y, H:i')
                    ],
                    'steps' => $steps,
                    'route_points' => $routePoints,
                    'options' => [
                        'avoid_tolls' => $validated['avoid_tolls'] ?? false,
                        'fastest_route' => $validated['fastest_route'] ?? false,
                        'avoid_crowds' => $validated['avoid_crowds'] ?? false
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Scheduling Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate detailed route steps
     */
    protected function generateDetailedRouteSteps($origin, $destination, $distanceData, $transitMode, $departureTime)
    {
        $durationSeconds = $distanceData['duration']['value'];
        $totalDistance = $distanceData['distance']['value'] / 1000;

        $steps = [];
        $currentTime = $departureTime->copy();

        // Step 1: Titik Awal
        $steps[] = [
            'type' => 'start',
            'icon' => 'fa-solid fa-location-dot',
            'time' => $currentTime->format('H:i'),
            'title' => 'Titik Keberangkatan',
            'description' => $origin['formatted_address'],
            'distance' => null,
            'duration' => null,
            'instruction' => 'Mulai perjalanan dari lokasi ini'
        ];

        // Untuk transportasi umum, tambahkan langkah jalan kaki
        if (in_array($transitMode, ['bus', 'train', 'subway', 'tram'])) {
            // Jalan ke halte/stasiun
            $walkToStationTime = 8; // 8 menit
            $currentTime->addMinutes($walkToStationTime);

            $steps[] = [
                'type' => 'walk',
                'icon' => 'fa-solid fa-person-walking',
                'time' => $currentTime->format('H:i'),
                'title' => 'Jalan Kaki',
                'description' => 'Menuju ' . $this->getTransitStationName($transitMode) . ' terdekat',
                'distance' => '~450 m',
                'duration' => $walkToStationTime . ' menit',
                'instruction' => 'Berjalan menuju pemberhentian terdekat'
            ];

            // Tunggu di halte/stasiun
            $waitTime = 5;
            $currentTime->addMinutes($waitTime);

            $steps[] = [
                'type' => 'wait',
                'icon' => 'fa-solid fa-clock',
                'time' => $currentTime->format('H:i'),
                'title' => 'Menunggu',
                'description' => 'Tunggu ' . $this->getTransitLabel($transitMode) . ' tiba',
                'distance' => null,
                'duration' => '~' . $waitTime . ' menit',
                'instruction' => 'Tunggu kendaraan datang'
            ];
        }

        // Step utama: Naik transportasi
        $mainTransitDuration = $durationSeconds / 60; // dalam menit

        if (in_array($transitMode, ['bus', 'train', 'subway', 'tram'])) {
            $mainTransitDuration -= 13; // Kurangi waktu jalan dan tunggu
        }

        if ($mainTransitDuration < 5) $mainTransitDuration = 5;

        $currentTime->addMinutes($mainTransitDuration);

        $steps[] = [
            'type' => 'transit',
            'icon' => 'fa-solid fa-' . $this->getTransitIcon($transitMode),
            'time' => $currentTime->format('H:i'),
            'title' => 'Naik ' . $this->getTransitLabel($transitMode),
            'description' => 'Perjalanan menuju tujuan',
            'distance' => number_format($totalDistance, 1) . ' km',
            'duration' => round($mainTransitDuration) . ' menit',
            'instruction' => 'Tetap di kendaraan sampai tujuan'
        ];

        // Jalan kaki dari halte ke tujuan akhir (untuk transit)
        if (in_array($transitMode, ['bus', 'train', 'subway', 'tram'])) {
            $walkFromStationTime = 7;
            $currentTime->addMinutes($walkFromStationTime);

            $steps[] = [
                'type' => 'walk',
                'icon' => 'fa-solid fa-person-walking',
                'time' => $currentTime->format('H:i'),
                'title' => 'Jalan Kaki',
                'description' => 'Dari pemberhentian ke tujuan akhir',
                'distance' => '~350 m',
                'duration' => $walkFromStationTime . ' menit',
                'instruction' => 'Berjalan menuju lokasi tujuan'
            ];
        }

        // Step akhir: Tiba di tujuan
        $steps[] = [
            'type' => 'end',
            'icon' => 'fa-solid fa-flag-checkered',
            'time' => $currentTime->format('H:i'),
            'title' => 'Tiba di Tujuan',
            'description' => $destination['formatted_address'],
            'distance' => null,
            'duration' => null,
            'instruction' => 'Anda telah sampai di tujuan'
        ];

        return $steps;
    }

    /**
     * Generate route points untuk polyline di peta
     */
    protected function generateRoutePoints($latStart, $lngStart, $latEnd, $lngEnd)
    {
        // Generate intermediate points untuk membuat rute yang smooth
        $points = [];
        $numPoints = 10;

        for ($i = 0; $i <= $numPoints; $i++) {
            $fraction = $i / $numPoints;
            $lat = $latStart + ($latEnd - $latStart) * $fraction;
            $lng = $lngStart + ($lngEnd - $lngStart) * $fraction;

            $points[] = [
                'lat' => $lat,
                'lng' => $lng
            ];
        }

        return $points;
    }

    /**
     * Prediksi crowd level berdasarkan waktu
     */
    protected function predictCrowdLevel(Carbon $dateTime): string
    {
        $hour = $dateTime->hour;
        $isWeekend = $dateTime->isWeekend();

        if ($isWeekend) {
            if ($hour >= 10 && $hour <= 15) {
                return 'Ramai';
            }
            return 'Sedang';
        }

        // Weekday
        if (($hour >= 7 && $hour <= 9) || ($hour >= 17 && $hour <= 19)) {
            return 'Sangat Ramai'; // Rush hour
        } elseif ($hour >= 10 && $hour <= 16) {
            return 'Sedang';
        }

        return 'Sepi';
    }

    /**
     * Helper functions
     */
    protected function getTransitStationName($mode)
    {
        return [
            'bus' => 'Halte Bus',
            'train' => 'Stasiun Kereta',
            'subway' => 'Stasiun Subway',
            'tram' => 'Halte Tram'
        ][$mode] ?? 'Halte';
    }

    protected function getTransitIcon($mode)
    {
        return [
            'bus' => 'bus',
            'train' => 'train',
            'subway' => 'train-subway',
            'tram' => 'train-tram',
            'car' => 'car',
            'plane' => 'plane'
        ][$mode] ?? 'bus';
    }

    protected function getTransitLabel($mode)
    {
        return [
            'bus' => 'Bus',
            'train' => 'Kereta',
            'subway' => 'Subway',
            'tram' => 'Tram',
            'car' => 'Mobil Pribadi',
            'plane' => 'Pesawat'
        ][$mode] ?? 'Bus';
    }
}
