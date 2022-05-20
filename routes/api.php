<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Support\Arr;

Route::get('/books', '\App\Http\Controllers\API\BookController@index');
Route::get('/books/{book}/openLibrary', '\App\Http\Controllers\API\BookController@viewOpenLibrary');
Route::get('/books/{book}', fn (Book $book) => $book);
Route::get('/books/{book}/authors', fn (Book $book) => Arr::pluck($book->load('author_book.author')['author_book'], 'author')); // prettify
Route::get('/books/{book}/genres', fn (Book $book) => Arr::pluck($book->load('book_genre.genre')['book_genre'], 'genre')); // prettify

Route::get('/authors', '\App\Http\Controllers\API\AuthorController@index');
Route::get('/authors/{author}', fn (Author $author) => $author);

Route::get('/genres', '\App\Http\Controllers\API\GenreController@index');
Route::get('/genres/{genre}', fn (Genre $genre) => $genre);
