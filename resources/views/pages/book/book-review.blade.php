@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="/">Back</a>
        </div>
        <div class="book-review">
            <div class="row">
                <div class="col">
                    <img class="book-review-image" src="{{ URL::asset('storage/'.$singleBook->cover) }}" alt="book cover image">
                </div>
                <div class="col">
                    <div class="single-book-title">
                        <h2>{{$singleBook->title}}</h2>
                    </div>
                    <hr>
                    <div class="single-book-authors">
                        <ul>
                            @foreach ($singleBook->authors as $author)
                                <li><h5>{{$author->fullname}}</h5></li>
                            @endforeach
                        </ul>
                    </div>
                        <ul>
                            @foreach ($singleBook->genres as $genre)
                                <li><h5><span class="badge badge-pill badge-secondary">{{$genre->name}}</span></h5></li>
                            @endforeach
                        </ul>
                    <div class="single-book-description">
                        {{$singleBook->description}}
                    </div>
                </div>
            </div>
        </div>

        <h3>Reviews</h3>
            @foreach ($singleBook->reviews as $review)
                <p>{{$review->comment}}</p>
            @endforeach
        <hr>
        <button class="btn btn-default" onclick="showCommentForm()">Leave a comment about this book</button>
        <div class="hidden-comment-form" id="commentForm">
            <button type="button" class="close mb-2" aria-label="Close" onclick="closeCommentForm()">
                <span aria-hidden="true">&times;</span>
            </button>
            {!! Form::open(['action' => 'App\Http\Controllers\ReviewsController@storeBookReview', 'method' => 'post']) !!}
            <input type="hidden" name="book_id" value="{{$singleBook->id}}">
            <div class="form-group">
                {{Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Leave your comment about this book here..'])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
            {!! Form::close() !!}
            {{-- <button class="btn btn-primary" >Close</button> --}}
        </div>
    </div>
@endsection