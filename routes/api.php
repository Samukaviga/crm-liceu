<?php

use App\Http\Controllers\api\CrmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/crm/upload', [CrmController::class, 'store']);

Route::get('/crm/data', [CrmController::class, 'data']);
