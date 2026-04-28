<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CrowdMetrics;
use App\Models\Destination;
use App\Models\Feature;
use App\Models\IotDevice;
use App\Models\WeatherReference;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $features = Feature::query()->active()->ordered()->get()->map->toUiArray()->values();
        $featuredDestinations = Destination::query()->with('category')->featured()->ordered()->take(3)->get()->map->toUiArray()->values();
        $previewDestinations = Destination::query()->with('category')->ordered()->take(3)->get()->map->toUiArray()->values();

        return view('welcome', [
            'features' => $features,
            'featuredDestinations' => $featuredDestinations,
            'previewDestinations' => $previewDestinations,
            'pageStats' => [
                'destinations' => Destination::count(),
                'categories' => Category::count(),
                'devices' => IotDevice::where('is_active', true)->count(),
                'signals' => CrowdMetrics::count(),
                'weatherProfiles' => WeatherReference::count(),
            ],
        ]);
    }

    public function features(): View
    {
        $features = Feature::query()->active()->ordered()->get()->map->toUiArray()->values();
        $featuredDestinations = Destination::query()->with('category')->featured()->ordered()->take(4)->get()->map->toUiArray()->values();

        return view('features', [
            'features' => $features,
            'featuredDestinations' => $featuredDestinations,
            'pageStats' => [
                'destinations' => Destination::count(),
                'categories' => Category::count(),
                'devices' => IotDevice::where('is_active', true)->count(),
                'signals' => CrowdMetrics::count(),
            ],
        ]);
    }

    public function streetView(): View
    {
        $destinations = Destination::query()->with('category')->ordered()->get()->map->toUiArray()->values();

        return view('street-view-page', [
            'destinations' => $destinations,
            'defaultDestination' => $destinations->first(),
        ]);
    }

    public function aiMonitor(): View
    {
        $destinations = Destination::query()->with('category')->ordered()->get()->map->toUiArray()->values();

        return view('ai-monitor-page', [
            'destinations' => $destinations,
            'defaultDestination' => $destinations->first(),
        ]);
    }
}