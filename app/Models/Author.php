<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AuthorBook;
use App\Models\BookGenre;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function author_book()
    {
        return $this->hasMany(AuthorBook::class);
    }

    public function book_genre()
    {
        return $this->hasMany(BookGenre::class);
    }
}
