<?php

use Illuminate\Support\Facades\Route;

Route::get('/books/create', '\App\Http\Controllers\Web\BookController@create');
Route::post('/books/create', '\App\Http\Controllers\Web\BookController@store');
Route::get('/books/{book}', '\App\Http\Controllers\Web\BookController@edit');
Route::post('/books/{book}', '\App\Http\Controllers\Web\BookController@update');
