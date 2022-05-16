<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Utilities\Search;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        // Return genres, optionally with 'name' as search term
        $q = new Genre;
        $q = Search::search($q, ['name' => $request->input('name')]);
        return $q->get();
    }
}
