<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/features', [PageController::class, 'features'])->name('features');
Route::get('/street-view', [PageController::class, 'streetView'])->name('street-view');
Route::get('/ai-monitor', [PageController::class, 'aiMonitor'])->name('ai-monitor');

require __DIR__ . '/ai-route.php';
require __DIR__ . '/personalization.php';
require __DIR__ . '/immersive.php';
require __DIR__ . '/destinations.php';
require __DIR__.'/akbar/web.php';