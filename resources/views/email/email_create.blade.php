@extends('layouts.app')

@section('content')
        <div class="container">
            <h3 class="mb-4">Report page</h3>
            <div class="card" style="width: 100%">
                <div class="report-container" style="padding: 23px;">
                <div class="row" >
                        <div class="col-4">
                            <img style="width: 230px; border-radius: 3px" src="{{ URL::asset('storage/'.$book->cover) }}" alt="book cover image">
                        </div>
                        <div class="col">
                            <h5 class="mt-4">Report for book: <strong style="text-transform: capitalize">{{ $book->title }}</strong></h5>
                            {!! Form::open(['action' => ['App\Http\Controllers\Mail\MailController@sendReportMessage', $book->slug], 'method' => 'post']) !!}
                        <input type="hidden" name="book_slug" value="{{ $book->slug }}">
                            <div class="form-group mt-4">
                                {{Form::hidden('book_title', ($book->title), ['class' => 'form-control', 'placeholder' => 'Leave your comment about this book here..'])}}
                            </div>
                            <div class="form-group mt-4">
                                {{Form::textarea('report_message', null, ['class' => 'form-control', 'rows' => 9, 'placeholder' => 'Your report message'])}}
                            </div>
                            <div class="row justify-content-end">
                                {{Form::submit('Send Report', ['class' => 'btn btn-outline-dark mr-3'])}}
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection