<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewsController extends Controller
{
      
    public function storeBookReview(Request $request) 
    {
        $user_id = Auth()->user()->id;
       
       $this->validate($request, [
           'comment' => 'required' 
       ]);

       $bookReview = new Review();
       $bookReview->comment = $request->input('comment');
       $bookReview->book_id = $request->input('book_id');
       $bookReview->user_id = $user_id;

       $bookReview->save();

       return redirect()->back();
    }
}
