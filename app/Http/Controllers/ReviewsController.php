<?php

namespace App\Http\Controllers;

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
       $bookReviewPivot = new BookReview();
       
       $bookReviewComment->book_id = $request->input('book_id');
       $bookReviewComment->user_id = $user_id;
       $bookReviewComment->comment = $request->input('comment');
       $bookReviewComment->save();
       
       $bookReviewPivot->book_id = $request->input('book_id');
       $lastId = $bookReviewComment->id;
       $bookReviewPivot->review_id = $lastId;
       
        $bookReviewPivot->save();

       return redirect()->back();
    }
}
