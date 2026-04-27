<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('akbar.street-view.index');
});

require __DIR__ . '/ai-route.php';
require __DIR__ . '/personalization.php';
require __DIR__ . '/immersive.php';
require __DIR__.'/akbar/web.php';