<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

    
    public function updateEmailView($id)
    {
       $user = User::find($id);
        return view('pages.user.change_email')->with('user', $user);
    }


    public function updateEmail(Request $request, $id)
    {
        $user = User::find($id);
        $user->email = $request->input('new_email');
        $user->save();

        return redirect()->back();
    }
}
