<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
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
        //$books = Book::all();
        $books = Book::with('genres')->get();
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

        $user_id = Auth()->user()->id;

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'authors' => 'required',
            'price' => 'required',
            'cover' => 'required'
        ]);
        
        $book = new Book();
        $book->user_id = $user_id;
        $book->title = $request->input('title');
        $slug = Str::slug($request->input('title'));
        $book->slug = $slug;
        $book->description = $request->input('description');
        $book->authors = $request->input('authors');
        $book->price = $request->input('price');
        $book->cover = $request->file('cover')->store('images', 'public');

        $book->save();

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
