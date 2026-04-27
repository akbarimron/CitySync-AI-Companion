<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/immersive.php';
require __DIR__ . '/ai-route.php';
require __DIR__ . '/personalization.php';