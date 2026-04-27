<?php

use App\Http\Controllers\Akbar\AiMonitorController;
use App\Http\Controllers\Akbar\StreetViewController;
use Illuminate\Support\Facades\Route;

Route::prefix('akbar')
    ->name('akbar.')
    ->group(function (): void {
        Route::get('/street-view', [StreetViewController::class, 'index'])->name('street-view.index');
        Route::get('/ai-monitor', [AiMonitorController::class, 'index'])->name('ai-monitor.index');
        Route::post('/ai-monitor', [AiMonitorController::class, 'analyze'])->name('ai-monitor.analyze');
    });
