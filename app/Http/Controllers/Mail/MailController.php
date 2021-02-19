<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;
use App\Models\Book;


class MailController extends Controller
{
    
    public function emailTemplate(Request $request, $slug)
    {
        $book = Book::where('slug', '=',  $slug)->firstOrFail();
        return view('email.email_create')->with('book', $book);
    }
    
    public function sendReportMessage(Request $request)
    {
        $book_title = $request->input('book_title');
        $report_message = $request->input('report_message');
        $book_slug = $request->input('book_slug');

        $data = [];
        $data['title'] = $book_title;
        $data['report_message'] = $report_message;
        $data['book_url'] = $book_slug;

        Mail::to('salminas@gmail.com')->send(new sendMail($data));

        return redirect()->back();
    }
}
