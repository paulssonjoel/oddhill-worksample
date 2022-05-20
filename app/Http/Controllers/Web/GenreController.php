<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    protected static $validationRules = [
    'name' => ['filled', 'max:255'],
    ];

    public function create(Request $request)
    {
        // Create form
        return view('genres.create');
    }

    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate(['name' => array_merge(['required'], static::$validationRules['name'])]);

        // Store genre
        $genre = new Genre;
        $genre->name = $validated['name'];
        $genre->save();

        // Redirect back
        return back();
    }
}
