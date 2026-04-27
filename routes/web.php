<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/street-view', function () {
    return view('street-view-page');
});

Route::get('/ai-monitor', function () {
    return view('ai-monitor-page');
});

require __DIR__ . '/ai-route.php';
require __DIR__ . '/personalization.php';
require __DIR__ . '/immersive.php';
require __DIR__ . '/destinations.php';
require __DIR__.'/akbar/web.php';