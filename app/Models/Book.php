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
        //$data = DB::table('books')->where('slug', $slug)->get()->first();
        $data = Book::with('genres')->where('slug', $slug)->get()->first();
        
        // $data = DB::table('books')
        //         ->join('users', 'users.id', '=', 'books.user_id')
        //         ->select('books.id', 
        //                  'books.user_id', 
        //                  'books.title',
        //                  'books.slug',
        //                  'books.description',
        //                  'books.authors',
        //                  'books.price',
        //                  'books.cover',
        //                  'users.email AS user')
        //                  ->where('slug', $slug)->get()->first();
        return $data;
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

}
