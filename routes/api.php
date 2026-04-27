<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShoeController;
use App\Http\Controllers\ShoeDetailController;

Route::prefix('shoes')->controller(ShoeController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::delete('/{id}/destroy', 'destroy');
});

Route::prefix('shoe-details')->controller(ShoeDetailController::class)->group(function () {
    Route::get('/{id}/shoes', 'getShoes');
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::delete('/{id}/destroy', 'destroy');
});
