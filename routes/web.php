<?php

use Illuminate\Support\Facades\Route;

Route::get('/books/create', '\App\Http\Controllers\Web\BookController@create');
Route::post('/books/create', '\App\Http\Controllers\Web\BookController@store');
Route::get('/books/{book}', '\App\Http\Controllers\Web\BookController@edit');
Route::post('/books/{book}', '\App\Http\Controllers\Web\BookController@update');
Route::post('/books/{book}/delete', '\App\Http\Controllers\Web\BookController@destroy');

Route::get('/authors/create', '\App\Http\Controllers\Web\AuthorController@create');
Route::post('/authors/create', '\App\Http\Controllers\Web\AuthorController@store');
Route::get('/authors/{author}', '\App\Http\Controllers\Web\AuthorController@edit');
Route::post('/authors/{author}', '\App\Http\Controllers\Web\AuthorController@update');
Route::post('/authors/{author}/delete', '\App\Http\Controllers\Web\AuthorController@destroy');

Route::get('/genres/create', '\App\Http\Controllers\Web\GenreController@create');
Route::post('/genres/create', '\App\Http\Controllers\Web\GenreController@store');
Route::get('/genres/{genre}', '\App\Http\Controllers\Web\GenreController@edit');
Route::post('/genres/{genre}', '\App\Http\Controllers\Web\GenreController@update');
Route::post('/genres/{genre}/delete', '\App\Http\Controllers\Web\GenreController@destroy');
