<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeEmailRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
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
        $user_books = Book::with('authors', 'genres')->where('user_id', '=', $user_id)->latest()->paginate(15);
        return view('pages.user.index')->with('user_books', $user_books);
    }

    
    public function changeEmailView()
    {
        return view('pages.user.change_email');
    }


    public function changeEmail(ChangeEmailRequest $request, $id)
    {
        if($request->validated())
        {
            $user = User::find($id);
            $user->email = $request->input('email');
            $user->save();

            return redirect()->back()->with('success', 'Email changed successfully!');
        } else {
            return redirect()->back()->with('error', 'Error!');
        }
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);
        File::delete($book->cover);
        $book->delete();

        return redirect()->back()->with('success', 'Your book deleted!');
    }


    public function updateBookView($slug)
    {
        $book = Book::with('authors', 'users', 'genres')->where('slug', '=', $slug)->firstOrFail();
        return view('pages.user.book_update')->with('book', $book);
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

        return redirect()->back()->with('success', 'Your book successfully updated!');
    }
}
