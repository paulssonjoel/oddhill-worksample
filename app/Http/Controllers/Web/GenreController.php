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

    public function edit(Request $request, Genre $genre)
    {
        // Edit form
        return view('genres.edit', ['genre' => $genre]);
    }

    public function update(Request $request, Genre $genre)
    {
        // Validate
        $validated = $request->validate(['name' => static::$validationRules['name']]);

        // Update genre
        $genre->fill($validated);
        $genre->save();

        return back();
    }

    public function destroy(Request $request, Genre $genre)
    {
        $genre->books()->detach();
        $genre->delete();
        return redirect('/admin/genres/create');
    }
}
