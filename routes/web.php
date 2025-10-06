<?php

use App\Http\Controllers\CrmController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('excel', [CrmController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('excel');


Route::post('excel/import', [CrmController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('excel.import');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
