<?php

use Illuminate\Support\Facades\Route;

Route::get('/books/create', '\App\Http\Controllers\Web\BookController@create');
Route::post('/books/create', '\App\Http\Controllers\Web\BookController@store');
Route::get('/books/{id}', '\App\Http\Controllers\Web\BookController@edit');
Route::post('/books/{id}', '\App\Http\Controllers\Web\BookController@put');
