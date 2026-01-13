<?php

use App\Http\Controllers\Api\CrmController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\TemplatesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('auth/Login');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/test-broadcast', function () {
    broadcast(new \App\Events\TestEvent());
    return 'Evento enviado!';
});

Route::get('excel', [CrmController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('excel');

Route::get('statistics', [StatisticsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('statistics');

Route::get('template', [TemplatesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('template');

Route::post('/templates', [TemplatesController::class, 'store'])
->middleware(['auth', 'verified'])
->name('template.store');


/*
Route::post('excel/import', [CrmController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('excel.import'); */

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
