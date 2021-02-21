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
        'price',
        'cover'
    ];

    protected $perPage = 25;


    public function getBookBySlug($slug)
    {   
        $data = Book::with('authors', 'genres', 'reviews', 'users')->where('slug', $slug)->firstOrFail();
        return $data;
    }

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
        return $this->hasMany(Review::class)->latest('created_at');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsNewAttribute()
    {
        return now()->subDays(7) <= $this->created_at;
    }

    public function getPriceWithDiscount()
    {
        $discount_percent = $this->discount;
        $discount = ($this->price / 100 * $discount_percent);
        $final_sum = ($this->price - $discount);

        return $final_sum;
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function getAverageBookRating()
    {
        return $this->reviews->avg('stars');
    }

}
