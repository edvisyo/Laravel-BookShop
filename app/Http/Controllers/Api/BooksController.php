<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceVue;
use App\Http\Resources\ReviewResource;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::with('authors', 'genres')->approved();
        return BookResource::collection($books->paginate(25))->response();
    }


    public function show(Book $book)
    {
        return (new BookResource($book->load('authors', 'genres')))->response();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Book Component
    public function createReview(Request $request)
    {
            $bookReviewComment = new Review();
            
            $bookReviewComment->book_id = $request->input('book_id');
            $bookReviewComment->user_id = $request->input('user_id');
            $bookReviewComment->stars = $request->input('stars');
            $bookReviewComment->comment = $request->input('comment');
            
            if($bookReviewComment->save()) {
                return new ReviewResource($bookReviewComment);
            }
    }


    public function showBook($slug)
    {
        $book = Book::with('authors', 'genres', 'reviews.user')->where('slug', $slug)->get();
        return BookResourceVue::collection($book)->response();
    }

}
