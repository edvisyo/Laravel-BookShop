<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'stars',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAverageBookRating()
    {
        // $stars = $this->stars;
        // $book_id = $this->book_id;
        // $total_book_rows = count((array)$book_id);
        // $total_stars = count((array)$stars);
        // $total_avg_rating = ($total_stars / $total_book_rows);

        // return $total_avg_rating;
        $stars = $this->stars;

        return $stars;
    }

}
