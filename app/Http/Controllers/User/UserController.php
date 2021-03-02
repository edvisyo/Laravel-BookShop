<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeEmailRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
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
        $user_books = Book::with('authors', 'genres')->where('user_id', Auth()->id())->latest()->paginate(15);
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

    public function changePasswordView()
    {
        return view('pages.user.change_password');
    }


    public function changePassword(ChangePasswordRequest $request, $id)
    {
        if($request->validated())
        {
            $user = User::find($id);
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully!');
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
        $book = Book::where('slug', $slug)->firstOrFail();
        $authors = $book->authors()->get()->implode('fullname', ', ');
        $genres = $book->genres()->get()->implode('name', ', ');

        $book->authors = $authors;
        $book->genres = $genres;

        return view('pages.user.book_update')->with('book', $book);
    }

    public function updateBook(Request $request, $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

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

        $authors = explode(',',$request->input('book_authors'));
        $genres = explode(',',$request->input('book_genres'));      

        $book->authors()->detach();
        $book->genres()->detach();
    
        foreach($authors as $author)
        {   
            $assignedAuthors = Author::where('fullname', $author)->firstOrCreate([ 'fullname' => $author]);
            $assignedAuthors->books()->attach($book);
        }
        
        foreach($genres as $genre)
        {
            $assignedGenres = Genre::where('name', $genre)->firstOrCreate([ 'name' => $genre]);
            $assignedGenres->books()->attach($book);
        }

        $book->price = $request->input('book_price');

        $book->save();

        return redirect()->back()->with('success', 'Your book successfully updated!');
    }
}
