<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
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
        $books = Book::with('authors', 'genres')->latest()->paginate(15);
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
        File::delete($book->cover);
        $book->delete();

        return redirect()->back()->with('success', 'Book deleted!');
    }

    public function changeEmailView()
    {
        return view('pages.admin.change_email');
    }

    public function updateEmail(ChangeEmailRequest $request, $id)
    {
        if($request->validated())
        {
            $user = User::find($id);
            $user->email = $request->input('email');
            $user->save();

            return redirect()->back()->with('success', 'Email updated!');
        } else {
            return redirect()->back()->with('error', 'Error!');
        }
    }

    public function changePasswordView()
    {
        return view('pages.admin.change_password');
    }

    public function changePassword(ChangePasswordRequest $request, $id)
    {
        if($request->validated()) {
            $user = User::find($id);
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully!');
        } else {
            return redirect()->back()->with('error', 'Error!');
        }
    }

    public function createNewUserView()
    {
        $roles = Role::all()->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)->pluck('name', 'id');
        return view('pages.admin.create_new_user')->with('roles', $roles);
    }

    public function createNewUser(CreateUserRequest $request)
    {        
        if($request->validated())
        {
            $user = new User();
            $role = $request->input('user_role');
            $user->username = $request->input('username');
            $user->birthdate = $request->input('birthdate');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            $user->save();

            $user->role()->attach($role);

        return redirect()->back()->with('success', 'New user created successfully!');
        } else {
            return redirect()->back()->with('error', 'Error!');
        }
    }

    public function updateBookView($slug)
    {
        $book = Book::with('authors', 'users', 'genres')->where('slug', '=', $slug)->firstOrFail();
        return view('pages.admin.book_update')->with('book', $book);
    }

    public function updateBook(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->firstOrFail();

        if($request->file('book_cover') != null)
        {
            $path = public_path('uploads/covers/');
            
            //code for remove old file
            if($book->cover != '' && $book->cover != null)
            {
                File::delete($book->cover);
            }

            //upload new file
            $cover = $request->file('book_cover');
            $extension = $cover->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $cover->move($path, $filename);
            $resizedImage = Image::make(public_path('uploads/covers/'.$filename))
            ->fit(180, 280)->save();
            //for update in table
            $book->update(['cover' => 'uploads/covers/'.$filename]);
        }

        $book->title = $request->input('book_title');
        $book->description = $request->input('book_description');
        $book->price = $request->input('book_price');
        $book->discount = $request->input('book_discount');

        $book->save();

        return redirect()->back()->with('success', 'Book successfully updated!');
    }
}
