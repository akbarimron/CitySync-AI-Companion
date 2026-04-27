<?php

namespace App\Http\Controllers\Akbar;

use App\Http\Controllers\Controller;
use App\Models\Akbar\StreetViewLocation;
use Illuminate\Contracts\View\View;

class StreetViewController extends Controller
{
    public function index(): View
    {
        $locations = StreetViewLocation::examples();

        return view('akbar.street-view', [
            'locations' => $locations,
            'defaultLocation' => $locations[0],
        ]);
    }
}
