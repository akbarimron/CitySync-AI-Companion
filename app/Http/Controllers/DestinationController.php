<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Contracts\View\View;

class DestinationController extends Controller
{
    public function index(): View
    {
        $destinations = Destination::query()->with('category')->ordered()->get()->map->toUiArray()->values();

        return view('destinations.index', [
            'destinations' => $destinations,
            'categories' => Category::query()->withCount('destinations')->orderBy('name')->get(),
        ]);
    }

    public function show(Destination $destination): View
    {
        $destination->load('category');

        $relatedDestinations = Destination::query()
            ->with('category')
            ->whereKeyNot($destination->id)
            ->ordered()
            ->take(4)
            ->get()
            ->map->toUiArray()
            ->values();

        return view('destinations.dashboard', [
            'destination' => $destination,
            'relatedDestinations' => $relatedDestinations,
        ]);
    }
}