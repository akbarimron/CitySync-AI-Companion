<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Personalization\Chatbot\ChatController;

Route::prefix('personalization')->group(function () {

    Route::get('/', function () {
        return view('personalization.index');
    });

    Route::get('/chatbot', [ChatController::class, 'index']);
    Route::post('/chatbot/send', [ChatController::class, 'sendMessage']);
});