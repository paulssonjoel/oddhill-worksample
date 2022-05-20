<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Genre;

class BookGenre extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'books_genres';
    protected $fillable = ['genre_id', 'author_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
