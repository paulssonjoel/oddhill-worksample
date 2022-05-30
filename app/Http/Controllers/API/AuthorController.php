<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        // Return authors, optionally with 'name' as search term
        $q = Author::search(['name' => $request->input('name')]);
        return $q->get();
    }
}
