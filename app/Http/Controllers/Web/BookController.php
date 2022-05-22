<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Utilities\Search;
use App\Models\Author;
use App\Models\BookGenre;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    protected static $validationRules = [
        'title' => ['filled', 'max:255'],
        'isbn' => ['filled', 'digits_between:1,13'],
        'authors' => ['array'],
        'authors.*' => ['distinct', 'exists:authors,id'],
        'genres' => ['array'],
        'genres.*' => ['distinct', 'exists:genres,id'],
        'description' => ['max:65535'],
    ];


    public function create(Request $request)
    {
        // Create form
        return view(
            'books.create',
            [
                // Genres/authors to select from
                'authors' => Author::all('id', 'name'),
                'genres' => Genre::all('id', 'name'),
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
                'genres' => array_merge(['required'], static::$validationRules['genres']),
                'genres.*' => array_merge(['required'], static::$validationRules['genres.*']),
                'description' => static::$validationRules['description'],
            ]
        );

        DB::transaction(
            function () use ($validated) {
                // Store book
                $book = new Book;
                $book->title = $validated['title'];
                $book->isbn = $validated['isbn'];
                $book->description = $validated['description'];
                $book->save();

                // Store author-book relationships
                $book->authors()->saveMany(Author::find($validated['authors']));

                // Store genre-book relationships
                foreach ($validated['genres'] as $id) {
                    $book->book_genre()->save(new BookGenre(['genre_id' => $id]));
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
                'possibleAuthors' => Author::all('id', 'name'),
                'possibleGenres' => Genre::all('id', 'name'),
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
                'genres' => static::$validationRules['genres'],
                'genres.*' => static::$validationRules['genres.*'],
            ]
        );

        DB::transaction(
            function () use ($validated, $book) {
                // Update book
                $book->fill(Arr::only($validated, ['title', 'isbn', 'description']));
                $book->save();

                if (isset($validated['authors'])) {
                    // Remove authors no longer selected
                    $book->authors()->whereNotIn('authors.id', $validated['authors'])->detach();

                    // Add newly selected authors
                    $book->authors()->saveMany(
                        Author
                            ::whereIn('id', $validated['authors']) // Get selected authors
                            ->whereDoesntHave('books', function (Builder $query) use ($book) {
                                $query->where('books.id', '==', $book->id);
                            }) // Relationship does not already exist
                            ->get()
                    );
                }

                if (isset($validated['genres'])) {
                    // Remove genres no longer selected
                    $book->book_genre()->whereNotIn('genre_id', $validated['genres'])->delete();

                    // Add newly selected genres
                    $newBookGenres = [];
                    foreach ($validated['genres'] as $id) {
                        if (!$book->book_genre->contains($id)) {
                            // Not in DB, add
                            $newBookGenres[] = new BookGenre(['genre_id' => $id]);
                        }
                    }
                    $book->book_genre()->saveMany($newBookGenres);
                }
            }
        );

        return back();
    }

    public function destroy(Request $request, Book $book)
    {
        $book->authors()->detach();
        $book->book_genre()->delete();
        $book->delete();
        return redirect('/admin/books/create');
    }
}
