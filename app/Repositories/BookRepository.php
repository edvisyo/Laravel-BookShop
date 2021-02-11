<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;


class BookRepository 
{
    public function getAllBooks()
    {
        $books = Book::all();
        return $books;
    }

    public function getBookBySlug(Request $request)
    {
        $slug = $request->slug;
        $book = new Book();
        $data = $book->getBookBySlug($slug);
        return $data;
    }

    // public function getUserBooks()
    // {
    //     $slug = $request->slug;
    //     $book = new Book();
    //     $data = $book->getBookBySlug($slug);
    //     return $data;
    // }


    // public function getAllBooksRelatedToUser()
    // {
    //     $books = Db::table('books')
    //              ->join('authors', 'authors.')
    //              ->select()
    // }
}