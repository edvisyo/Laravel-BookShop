<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class AdminController extends Controller
{
    
    public function __construct() {

        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $books = Book::with('authors', 'genres')->get();
        return view('pages.admin.index')->with('books', $books);
    }

    public function approveBook(Request $request, $id)
    {
        $book = Book::find($id);
        $book->approved = $request->input('set_approve_status');
        $book->save();

        return redirect()->back();
    }
}
