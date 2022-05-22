<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookGenre;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'isbn', 'description'];

    public $timestamps = false;

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_books');
    }

    public function book_genre()
    {
        return $this->hasMany(BookGenre::class);
    }
}
