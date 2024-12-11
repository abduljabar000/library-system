<?php

use App\Http\Controllers\Dashboard\API\DashboardApiController;
use App\Http\Controllers\Book\API\BookApiController;

Route::prefix('api')->group(function () {
    Route::get('/dashboard', [DashboardApiController::class, 'getDashboardStats']);
});

Route::prefix('books')->group(function () {
    Route::get('/', [BookApiController::class, 'index']);
    Route::post('/create', [BookApiController::class, 'store']);
    Route::get('/{id}', [BookApiController::class, 'show']);
    Route::put('/{id}', [BookApiController::class, 'update']);
    Route::delete('/{id}', [BookApiController::class, 'delete']);
});
