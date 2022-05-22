<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'biography'];

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class, 'authors_books');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'books_genres');
    }
}
