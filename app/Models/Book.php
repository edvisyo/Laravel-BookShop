<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'authors',
        'cover'
    ];

    public function getBookBySlug($slug)
    {   
        $data = Book::with('authors', 'genres', 'reviews', 'users')->where('slug', $slug)->firstOrFail();
        
        // $data = Book::with('authors', 'genres', 'reviews')
        // ->join('reviews', 'reviews.user_id', '=', 'books.user_id')
        // ->join('users', 'users.id', '=', 'reviews.user_id')
        // ->select('books.id', 
        //                  'books.user_id', 
        //                  'books.title',
        //                  'books.slug',
        //                  'books.description',
        //                  'books.price',
        //                  'books.cover',
        //                  'users.email AS user')
        // ->where('slug', $slug)->get()->first();
        
        // $data = DB::table('books')
        //         ->join('users', 'users.id', '=', 'books.user_id')
        //         ->select('books.id', 
        //                  'books.user_id', 
        //                  'books.title',
        //                  'books.slug',
        //                  'books.description',
        //                  //'books.authors',
        //                  'books.price',
        //                  'books.cover',
        //                  'users.email AS user')
        //                  ->where('slug', $slug)->get()->first();
        return $data;
    }

    // public function getUserBooks($user_id)
    // {
    //     $user_books = Book::with('authors', 'genres')->where('user_id', $user_id)->get();

    //     return $user_books;
    // }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
