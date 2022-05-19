<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Utilities\Search;

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
}
