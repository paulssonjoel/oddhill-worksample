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
}
