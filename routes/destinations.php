<?php

use Illuminate\Support\Facades\Route;

Route::prefix('destinations')->group(function () {
    
    Route::get('/', function () {
        return view('destinations.index');
    })->name('destinations.index');
    
    Route::get('/{destination}', function ($destination) {
        return view('destinations.dashboard', ['destination' => $destination]);
    })->name('destinations.show');
    
});
