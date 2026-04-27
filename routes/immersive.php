<?php

use Illuminate\Support\Facades\Route;

Route::prefix('immersive')->group(function () {

    Route::get('/', function () {
        return view('immersive.index');
    });

});