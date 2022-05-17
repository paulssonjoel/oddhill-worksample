<?php

use Illuminate\Support\Facades\Route;

Route::get('/books/create', fn() => view('books.create'));
Route::post('/books/create', '\App\Http\Controllers\BookController@store');
