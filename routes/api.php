<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Models\Book;
    use App\Models\Author;
    use App\Models\Genre;

    Route::get('/books', '\App\Http\Controllers\BookController@index');
    Route::get('/books/{book}', fn(Book $book) => $book);
    Route::get('/books/{book}/author', fn(Book $book) => Arr::pluck($book->load('author_book.author')['author_book'], 'author')); // prettify
    Route::get('/books/{book}/genre', fn(Book $book) => Arr::pluck($book->load('book_genre.genre')['book_genre'], 'genre')); // prettify

    Route::get('/authors', '\App\Http\Controllers\AuthorController@index');
    Route::get('/authors/{author}', fn() => Author::all());

    Route::get('/genres', '\App\Http\Controllers\GenreController@index');
    Route::get('/genres/{genre}', fn() => Genre::all());
