<?php


use App\Application\Book\RegisterBook;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Book\API\BookApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/books', [BookApiController::class, 'getFindAllBook']);
Route::post('/book/add', [BookApiController::class, 'registerBook']);
Route::get('/book/{id}', [BookApiController::class, 'getBook']);
Route::put('/book/{id}', [BookApiController::class, 'updateBook']);
Route::delete('/book/{id}', [BookApiController::class, 'deleteBook']);
