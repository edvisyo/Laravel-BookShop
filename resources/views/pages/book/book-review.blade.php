@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="/">Back</a>
        </div>
        <div class="book-review">
            <div class="row">
                <div class="col-5">
                    <img class="book-review-image" src="{{ URL::asset($singleBook->cover) }}" alt="book cover image">
                </div>
                <div class="col">
                    @if(Auth()->user() !== null)
                        <a href="/book/{{$singleBook->slug}}/report" class="book-report-link" style="color: black"><i class="far fa-paper-plane mr-3" style="text-decoration: underline; font-size: 17px"> Report book</i></a>
                    @endif
                    <div class="single-book-title">
                        <h2>{{$singleBook->title}}</h2>
                    </div>
                    <hr>
                    <ul>
                        @foreach ($singleBook->authors as $author)
                            <li><h5>{{$author->fullname}}</h5></li>
                        @endforeach
                        <li class="book-average-rating mr-3">
                            <strong>Rating: </strong>
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $singleBook->getAverageBookRating())
                                    <i class="fas fa-star rating-star-color star-resize"></i>
                                @else
                                    <i class="far fa-star empty-rating-star star-resize"></i>
                                @endif
                            @endfor
                        </li>
                    </ul>
                    <ul>
                        @foreach ($singleBook->genres as $genre)
                            <li><h5><span class="badge badge-pill badge-secondary genre-name">{{$genre->name}}</span></h5></li>
                        @endforeach
                    </ul>
                    <div class="single-book-description">
                        {{$singleBook->description}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <h3>Reviews</h3>
            </div>
            <div class="col">
                @if (Auth()->user())
                    <div class="row justify-content-end mr-1">
                        <button class="btn btn-dark btn-sm" onclick="showCommentForm()">Leave a comment about this book</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="hidden-comment-form" id="commentForm">
            <button type="button" class="close mb-2 mt-2" aria-label="Close" onclick="closeCommentForm()">
                <span aria-hidden="true">&times;</span>
            </button>
            <hr>
            {!! Form::open(['action' => 'App\Http\Controllers\Reviews\ReviewsController@storeBookReview', 'method' => 'post']) !!}
            <input type="hidden" name="book_id" value="{{$singleBook->id}}">
            
            <div class="rate-this-book">
                <strong>Rate this book!</strong>
            </div>
            <div class="stars">
                <input class="star star-5" id="star-5" type="radio" name="stars" value="5" /> <label class="star star-5" for="star-5"></label> <input class="star star-4" id="star-4" type="radio" name="stars" value="4" /> <label class="star star-4" for="star-4"></label> <input class="star star-3" id="star-3" type="radio" name="stars" value="3" /> <label class="star star-3" for="star-3"></label> <input class="star star-2" id="star-2" type="radio" name="stars" value="2" /> <label class="star star-2" for="star-2"></label> <input class="star star-1" id="star-1" type="radio" name="stars" value="1" /> <label class="star star-1" for="star-1"></label>
            </div>
            
            <div class="form-group">
                {{Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Leave your comment about this book here..'])}}
            </div>
            <div class="row justify-content-center">
                {{Form::submit('Share comment', ['class' => 'btn btn-success custom-submit-button'])}}
            </div>
            {!! Form::close() !!}
        </div>

        <hr>
            
            @forelse ($singleBook->reviews as $review)
                <div class="card mb-2">
                    <div class="comment-container" style="padding: 10px;">
                        <div class="row">
                            <div class="col">
                                @<b>{{$review->user->username}}</b>
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->stars)
                                        <i class="fas fa-star rating-star-color"></i>
                                    @else
                                        <i class="far fa-star empty-rating-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="col">
                                <div class="row justify-content-end mr-2">
                                    <small>{{$review->created_at->todatestring()}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="comment mt-2">
                            <p>{{$review->comment}}</p>
                        </div>
                    </div>
                </div>
            @empty
                <span>This book do not have a review..</span>
            @endforelse
    </div>
@endsection