<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Utilities\Search;
use Illuminate\Support\Facades\Http;

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
