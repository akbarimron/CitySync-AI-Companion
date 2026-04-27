<?php

use Illuminate\Support\Facades\Route;

Route::prefix('ai-route')->group(function () {

    Route::get('/', function () {
        return view('ai-route.index');
    });

});