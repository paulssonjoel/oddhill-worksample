<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    protected static $validationRules = [
        'name' => ['filled', 'max:255'],
        'biography' => ['max:65535'],
    ];

    public function create(Request $request)
    {
        // Create form
        return view('authors.create');
    }

    public function store(Request $request)
    {
        // Validate
        $validated = $request->validate(
            [
                'name' => array_merge(['required'], static::$validationRules['name']),
                'biography' => static::$validationRules['biography'],
            ]
        );

        // Store author
        $author = new Author;
        $author->name = $validated['name'];
        $author->biography = $validated['biography'];
        $author->save();

        // Redirect back
        return back();
    }

    public function edit(Request $request, Author $author)
    {
        // Edit form
        return view('authors.edit', ['author' => $author]);
    }

    public function update(Request $request, Author $author)
    {
        // Validate
        $validated = $request->validate(
            [
                'name' => static::$validationRules['name'],
                'biography' => static::$validationRules['biography'],
            ]
        );

        // Update author
        $author->fill($validated);
        $author->save();

        return back();
    }

    public function destroy(Request $request, Author $author)
    {
        $author->books()->detach();
        $author->delete();
        return redirect('/admin/authors/create');
    }
}
