<?php

use App\Http\Controllers\Api\CrmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/crm/upload', [CrmController::class, 'store']);

Route::get('/crm/data', [CrmController::class, 'data']);

Route::get('/test-broadcast', function () {
    broadcast(new \App\Events\TestEvent());
    return 'Evento enviado!';
});
