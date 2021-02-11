<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class UserController extends Controller
{
    
    public function __construct() {

        $this->middleware('auth');
        $this->middleware('user');
    }
    
    public function index()
    {
        $user_id = Auth()->user()->id;
        $user_books = Book::with('authors', 'genres')->where('user_id', '=', $user_id)->get();
        return view('pages.user.index')->with('user_books', $user_books);
    }
}
