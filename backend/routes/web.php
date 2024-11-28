<?php

use App\Http\Controllers\Book\WEB\BookWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book/add', [BookWebController::class, 'registerBook']);
Route::get('/book/{id}', [BookWebController::class, 'getBook']);
Route::put('/book/{id}', [BookWebController::class, 'updateBook']);
Route::delete('/book/{id}', [BookWebController::class, 'deleteBook']);
Route::get('/books', [BookWebController::class, 'getFindAllBook']);
