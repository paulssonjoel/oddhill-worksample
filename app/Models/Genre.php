<?php

namespace App\Models;

use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    use Search;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_genres');
    }
}
