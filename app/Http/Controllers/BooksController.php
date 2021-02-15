<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\BookGenre;
use App\Repositories\BookRepository;
use Illuminate\Support\Str;

class BooksController extends Controller
{

    private $bookRepository;
    
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    // public function getBooks()
    // {
    //     $books = $this->bookRepository->getAllBooks();
    //     return view('index')->with('books', $books);
    // }

    // public function getSingleBook(Request $request)
    // {
    //     $singleBook = $this->bookRepository->getBookBySlug($request);
    //     return view('pages.book.book-review')->with('singleBook', $singleBook);
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$books = Book::orderBy('created_at', 'desc')->peginate(3);
        $books = Book::with('authors')->get();
        return view('index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.book.book-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'authors' => 'required',
            'genres' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'cover' => 'required'
        ]);
        
        $book = auth()->user()->book()->create([
            'title' => $request['title'],
            $slug = Str::slug($request['title']),
            'slug' => $slug,
            'description' => $request['description'],
            'price' => $request['price'],
            'cover' => $request->file('cover')->store('images', 'public')
        ]);
        
        
        
        $book->genres()->attach($request->input('genres'));

        $authors = explode(',', $request->input('authors'));
        foreach ($authors as $authorName) {
            $author = Author::updateOrCreate(['fullname' => $authorName]);
            $book->authors()->attach($author->id);
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }
    public function getSingleBook(Request $request)
    {
        $singleBook = $this->bookRepository->getBookBySlug($request);
        return view('pages.book.book-review')->with('singleBook', $singleBook);
    }

    public function getBookReviews(request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
