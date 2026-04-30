<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class DistanceMatrixService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.distance_matrix.key');
        $this->baseUrl = config('services.distance_matrix.base_url');
    }

    /**
     * Geocode: Konversi alamat menjadi koordinat lat/lng
     */
    public function geocodeAddress(string $address): ?array
    {
        try {
            $cacheKey = 'geocode_' . md5($address);

            return Cache::remember($cacheKey, 3600, function () use ($address) {
                $url = "{$this->baseUrl}/geocode/json";

                $response = Http::timeout(15)->get($url, [
                    'region' => 'id',
                    'address' => $address,
                    'key' => $this->apiKey
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    if ($data['status'] === 'OK' && !empty($data['result'])) {
                        $result = $data['result'][0];

                        return [
                            'status' => 'success',
                            'formatted_address' => $result['formatted_address'] ?? $address,
                            'latitude' => $result['geometry']['location']['lat'],
                            'longitude' => $result['geometry']['location']['lng'],
                            'address_components' => $result['address_components'] ?? []
                        ];
                    }
                }

                Log::warning('Geocode API returned non-OK status', [
                    'address' => $address,
                    'response' => $response->json()
                ]);

                return null;
            });
        } catch (\Exception $e) {
            Log::error('Geocode API Error', [
                'address' => $address,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Distance Matrix: Hitung jarak dan waktu tempuh
     */
    public function calculateDistance(
        array $originCoords,
        array $destCoords,
        string $transitMode = 'bus',
        array $options = []
    ): ?array {
        try {
            $origins = "{$originCoords['lat']},{$originCoords['lng']}";
            $destinations = "{$destCoords['lat']},{$destCoords['lng']}";

            $params = [
                'origins' => $origins,
                'destinations' => $destinations,
                'departure_time' => $options['departure_time'] ?? 'now',
                'language' => 'id',
                'key' => $this->apiKey
            ];

            // Tentukan mode berdasarkan jenis transportasi
            if (in_array($transitMode, ['bus', 'train', 'subway', 'tram'])) {
                $params['mode'] = 'transit';
                $params['transit_mode'] = $transitMode;
            } elseif ($transitMode === 'car') {
                $params['mode'] = 'driving';

                // Avoid tolls jika diminta
                if (!empty($options['avoid_tolls'])) {
                    $params['avoid'] = 'tolls';
                }
            } elseif ($transitMode === 'plane') {
                // Untuk plane, gunakan driving sebagai estimasi
                $params['mode'] = 'driving';
            }

            $url = "{$this->baseUrl}/distancematrix/json";

            $response = Http::timeout(20)->get($url, $params);

            if ($response->successful()) {
                $data = $response->json();

                if ($data['status'] === 'OK' && !empty($data['rows'])) {
                    $element = $data['rows'][0]['elements'][0];

                    if ($element['status'] === 'OK') {
                        return [
                            'status' => 'success',
                            'origin_address' => $data['origin_addresses'][0] ?? '',
                            'destination_address' => $data['destination_addresses'][0] ?? '',
                            'distance' => [
                                'text' => $element['distance']['text'],
                                'value' => $element['distance']['value'] // dalam meter
                            ],
                            'duration' => [
                                'text' => $element['duration']['text'],
                                'value' => $element['duration']['value'] // dalam detik
                            ],
                            'transit_details' => $element['transit_details'] ?? null,
                            'raw_element' => $element
                        ];
                    } else {
                        Log::warning('Distance Matrix element status not OK', [
                            'status' => $element['status'],
                            'element' => $element
                        ]);
                    }
                }
            }

            Log::warning('Distance Matrix API returned invalid response', [
                'response' => $response->json()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Distance Matrix API Error', [
                'error' => $e->getMessage(),
                'origins' => $origins ?? 'N/A',
                'destinations' => $destinations ?? 'N/A'
            ]);
            return null;
        }
    }

    /**
     * Estimasi biaya berdasarkan jarak dan mode
     */
    public function estimateCost(float $distanceInKm, string $transitMode): array
    {
        // Biaya per km untuk setiap mode transportasi
        $costPerKm = [
            'bus' => 2500,
            'train' => 3500,
            'subway' => 3000,
            'tram' => 3000,
            'car' => 4500, // termasuk bensin + parkir
            'plane' => 80000 // estimasi untuk jarak pendek
        ];

        // Biaya minimum (flat fare)
        $minimumCost = [
            'bus' => 5000,
            'train' => 10000,
            'subway' => 8000,
            'tram' => 8000,
            'car' => 15000,
            'plane' => 500000
        ];

        $baseCost = $costPerKm[$transitMode] ?? 2500;
        $minCost = $minimumCost[$transitMode] ?? 5000;

        $calculatedCost = ceil($distanceInKm) * $baseCost;
        $totalCost = max($calculatedCost, $minCost);

        return [
            'cost' => $totalCost,
            'formatted' => 'Rp ' . number_format($totalCost, 0, ',', '.')
        ];
    }

    /**
     * Format durasi dari detik ke format human-readable
     */
    public function formatDuration(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);

        if ($hours > 0) {
            return "{$hours} jam {$minutes} menit";
        }
        return "{$minutes} menit";
    }

    /**
     * Konversi meter ke km dengan format
     */
    public function formatDistance(int $meters): string
    {
        $km = $meters / 1000;

        if ($km < 1) {
            return round($meters) . ' m';
        }

        return number_format($km, 1, ',', '.') . ' km';
    }
}
