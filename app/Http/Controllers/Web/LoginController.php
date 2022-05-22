<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function form()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Reject passwords other than 'pwd'
        if ($request->input('password') != 'pwd')
            return back()->withErrors(['password' => 'Invalid credentials']);

        // Set admin status
        session()->put('isAdmin', true);
        return redirect('/admin/books/create');
    }
}
