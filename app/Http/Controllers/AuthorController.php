<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Utilities\Search;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        // Return authors, optionally with 'name' as search term
        $q = new Author;
        $q = Search::search($q, ['name' => $request->input('name')]);
        return $q->get();
    }
}
