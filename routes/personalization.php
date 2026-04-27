<?php

use Illuminate\Support\Facades\Route;

Route::prefix('personalization')->group(function () {

    Route::get('/', function () {
        return view('personalization.index');
    });
});