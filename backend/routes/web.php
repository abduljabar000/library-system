<?php

use App\Http\Controllers\Book\WEB\BookWebController;
use Illuminate\Support\Facades\Route;

Route::controller(BookWebController::class)->group(function () {
    Route::get('/books', 'index')->name('book.index');
    Route::get('/books/create', 'create')->name('book.create');
    Route::get('/books/archive', 'viewArchive')->name('book.archive');
    Route::post('/books', 'store')->name('book.store');
    Route::get('/books/{id}', 'show')->name('book.show');
    Route::get('/books/{id}/edit', 'edit')->name('book.edit');
    Route::put('/books/{id}', 'update')->name('book.update');
    Route::delete('/books/{id}', 'destroy')->name('book.destroy');
});

Route::get('/', function () {
    return redirect()->route('book.index');
});
