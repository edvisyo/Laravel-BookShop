<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\BookReview;

class ReviewsController extends Controller
{
      
    public function storeBookReview(ReviewRequest $request) 
    {
  
       if($request->validated())
       {
            $bookReviewComment = new Review();
        
            $bookReviewComment->book_id = $request->input('book_id');
            $bookReviewComment->user_id = Auth()->id();
            $bookReviewComment->stars = $request->input('stars');
            $bookReviewComment->comment = $request->input('comment');
            $bookReviewComment->save();
    
            return redirect()->back()->with('success', 'Your comment was created successfully!');
       } else {
            return redirect()->back()->with('error', 'Error!');
       }
    }
}
