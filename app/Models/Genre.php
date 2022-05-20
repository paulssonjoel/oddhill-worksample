<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function book_genre()
    {
        return $this->hasMany(BookGenre::class);
    }
}
