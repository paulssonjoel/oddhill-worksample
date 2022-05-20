<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Utilities\Search;
use Illuminate\Support\Facades\Http;
use App\Models\Author;
use App\Models\AuthorBook;

class BookController extends Controller
{
    protected static $validationRules = [
    'title' => ['filled', 'max:255'],
    'isbn' => ['filled', 'digits_between:1,13'],
    'authors' => ['array'],
    'authors.*' => ['distinct', 'exists:authors,id'],
    'description' => ['max:65535'],
    ];


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
            'title' => array_merge(['required'], static::$validationRules['title']),
            'isbn' => array_merge(['required'], static::$validationRules['isbn']),
            'authors' => array_merge(['required'], static::$validationRules['authors']),
            'authors.*' => array_merge(['required'], static::$validationRules['authors.*']),
            'description' => static::$validationRules['description'],
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

                // Store author-book relationships
                foreach($validated['authors'] as $authorID) {
                    $authorBooks = new AuthorBook;
                    $authorBooks->author_id = $authorID;
                    $authorBooks->book_id = $book->id;
                    $authorBooks->save();
                }
            }
        );

        // Redirect back
        return back();
    }

    public function edit(Request $request, Book $book)
    {
        // Edit form
        return view(
            'books.edit',
            [
            'book' => $book,
            'possibleAuthors' => Author::all('id', 'name'), // List of authors to select from
            ]
        );
    }

    public function update(Request $request, Book $book)
    {
        // Validate
        $validated = $request->validate(
            [
            'title' => static::$validationRules['title'],
            'isbn' => static::$validationRules['isbn'],
            'authors' => static::$validationRules['authors'],
            'authors.*' => static::$validationRules['authors.*'],
            'description' => static::$validationRules['description'],
            ]
        );

        \DB::transaction(
            function () use ($validated, $book) {
                // Update book
                $book->fill(\Arr::only($validated, ['title', 'isbn', 'description']));
                $book->save();

                if(isset($validated['authors'])) {
                    // Remove authors no longer selected
                    $book->author_book()->whereNotIn('author_id', $validated['authors'])->delete();

                    // Add newly selected authors
                    $newAuthorBooks = [];
                    foreach($validated['authors'] as $authorID) {
                        if(!$book->author_book->contains($authorID)) {
                                  // Not in DB, add
                                  $newAuthorBooks[] = new AuthorBook(['author_id' => $authorID]);
                        }
                    }
                    $book->author_book()->saveMany($newAuthorBooks);
                }
            }
        );

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
