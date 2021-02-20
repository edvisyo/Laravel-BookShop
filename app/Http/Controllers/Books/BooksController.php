<?php

namespace App\Http\Controllers\Books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Models\BookGenre;
use App\Repositories\BookRepository;
use Illuminate\Support\Str;
use Cookie;
use Auth;
use Intervention\Image\Facades\Image;

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
    public function index(Request $request)
    {
        // if($request->has('search'))
        // {
        //     $search = $request->get('search');
        //     Cookie::queue('search' ,$search, (60 * 15));

        //     $books = Book::with(['authors' => function($query) use($search) {
        //     return $query->where('fullname', 'LIKE','%'.$search.'%');
        //     }])
        //     ->where('title','LIKE','%'.$search.'%')
        //     ->with('authors')
        //     ->approved()
        //     ->paginate();
        // } else {
        //     $books = Book::with('authors')->approved()->paginate();
        // }

        // return view('index')->with('books', $books);

        if($request->has('search'))
        {
            $search = $request->get('search');
            Cookie::queue('search' ,$search, (60 * 15));

            $books = Book::where('title', 'LIKE', '%' .$search. '%')
            ->orWhereHas('authors', function($query) use ($search) {
                return $query->where('fullname', 'LIKE', '%' . $search . '%');
            })->approved()->paginate();
        } else {
            $books = Book::with('authors')->approved()->paginate();
        }

        return view('index', compact('books')); 
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
            'book_cover' => 'required'
        ]);

        if($request->hasFile('book_cover'))
        {
            $file = $request->file('book_cover');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/covers/',$filename);

            $resizedImage = Image::make(public_path('uploads/covers/'.$filename))
            ->fit(180, 280)->save();
        } else {
            $filename = 'default.jpg';
        }
        
        $book = auth()->user()->book()->create([
            'title' => $request['title'],
            $slug = Str::slug($request['title']). ' ' . Str::random(),
            'slug' => $slug,
            'description' => $request['description'],
            'price' => $request['price'],
            'cover' => 'uploads/covers/'.$filename
        ]);
        
        $genres = explode(',', $request->input('genres'));
        foreach ($genres as $genreName) {
            $genre = Genre::updateOrCreate(['name' => $genreName]);
            $book->genres()->attach($genre->id);
        }

        $authors = explode(',', $request->input('authors'));
        foreach ($authors as $authorName) {
            $author = Author::updateOrCreate(['fullname' => $authorName]);
            $book->authors()->attach($author->id);
        }

        return redirect('/')->with('success', 'Your book is uploaded and waiting for approvement.');
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


    // public function search(Request $request)
    // {
    //     $search = $request->get('search');
    //     // $books = Book::with('authors')->approved()->where('title', 'LIKE', '%'.$search.'%', 'OR', 'authors', 'LIKE', '%'.$search.'%')->paginate();
    //     $books = Book::with('authors')->approved()->where('title', 'LIKE', '%'.$search.'%')->paginate();
    //     return view('index')->with('books', $books);
    // }

    // public function getBookReviews(request $request)
    // {
        
    // }

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
