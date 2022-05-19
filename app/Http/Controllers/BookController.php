<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Utilities\Search;
use Illuminate\Support\Facades\Http;
use App\Models\Author;
use App\Models\AuthorBook;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve books, optionally with 'isbn' and 'title' as search terms
        $q = new Book;

        $q = Search::search(
            $q, [
            'isbn' => $request->input('isbn'),
            'title' => $request->input('title'),
            ]
        );

        return $q->get();
    }

    public function create(Request $request)
    {
        // Create form
        return view(
            'books.create',
            [
            'authors' => Author::all('id', 'name'), // List of authors to select from
            ]
        );
    }

    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate(
            [
            'title' => 'required|filled|max:255',
            'isbn' => 'required|filled|digits_between:1,13',
            'author' => 'required|exists:authors,id',
            'description' => 'max:65535',
            ]
        );

        \DB::transaction(
            function () use ($validated) {
                // Store book
                $book = new Book;
                $book->title = $validated['title'];
                $book->isbn = $validated['isbn'];
                $book->description = $validated['description'];
                $book->save();

                // Store author-book relationship
                $authorBooks = new AuthorBook;
                $authorBooks->author_id = $validated['author'];
                $authorBooks->book_id = $book->id;
                $authorBooks->save();
            }
        );

        // Redirect back
        return back();
    }

    public function viewOpenLibrary(Request $request, Book $book)
    {
        // Query Open Library with ISBN
        $response = Http::accept('application/json')->get('https://openlibrary.org/isbn/'.$book->isbn)->json();

        if(!$response) {
            return response(null, 404);
        }

        return $response;
    }
}
