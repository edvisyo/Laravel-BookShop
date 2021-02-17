<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Book;
use App\Models\Role;
use App\Models\User;

class AdminController extends Controller
{
    
    public function __construct() {

        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index()
    {
        $books = Book::with('authors', 'genres')->orderBy('created_at', 'desc')->get();
        return view('pages.admin.index')->with('books', $books);
    }

    public function approveBook(Request $request, $id)
    {
        $book = Book::find($id);
        $book->approved = $request->input('set_approve_status');
        $book->save();

        return redirect()->back();
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->back();
    }

    public function changeEmailView()
    {
        return view('pages.admin.change_email');
    }

    public function updateEmail(Request $request, $id)
    {
        $user = User::find($id);
        $user->email = $request->input('new_email');
        $user->save();

        return redirect()->back();
    }

    public function changePasswordView()
    {
        return view('pages.admin.change_password');
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back();
    }

    public function createNewUserView()
    {
        $roles = Role::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('pages.admin.create_new_user')->with('roles', $roles);
    }

    public function createNewUser(Request $request)
    {        
        $user = new User();
        $role = $request->input('user_role');
        $user->username = $request->input('username');
        $user->birthdate = $request->input('birthdate');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        $user->role()->attach($role);

        return redirect()->back();
    }
}
