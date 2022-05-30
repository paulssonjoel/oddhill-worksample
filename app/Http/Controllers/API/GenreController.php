<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        // Return genres, optionally with 'name' as search term
        $q = Genre::search(['name' => $request->input('name')]);
        return $q->get();
    }
}
