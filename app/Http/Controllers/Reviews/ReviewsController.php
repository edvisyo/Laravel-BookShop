<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\BookReview;

class ReviewsController extends Controller
{
      
    public function storeBookReview(Request $request) 
    {
       $user_id = Auth()->user()->id;
       
       $this->validate($request, [
           'comment' => 'required' 
       ]);

       $bookReviewComment = new Review();
       
       $bookReviewComment->book_id = $request->input('book_id');
       $bookReviewComment->user_id = $user_id;
       $bookReviewComment->stars = $request->input('stars');
       $bookReviewComment->comment = $request->input('comment');
       $bookReviewComment->save();

       return redirect()->back();
    }
}
