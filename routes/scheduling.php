<?php

use App\Http\Controllers\Scheduling\SchedulingController;
use Illuminate\Support\Facades\Route;

// Web Routes untuk halaman scheduling
Route::get('/scheduling', [SchedulingController::class, 'index'])->name('scheduling.index');

// API Routes untuk scheduling (dengan prefix api)
Route::prefix('api/scheduling')->name('api.scheduling.')->group(function () {
    Route::post('/geocode', [SchedulingController::class, 'geocode'])->name('geocode');
    Route::post('/create', [SchedulingController::class, 'createSchedule'])->name('create');
});
