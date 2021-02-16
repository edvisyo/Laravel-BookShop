@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="book-container">

            {{-- @if (Auth()->user() != null)
            <div class="row justify-content-end">
                <a class="btn btn-primary mb-4 mr-4" href="{{ route('create')}}">
                    Add Book To Listing
                </a>
            </div>
            @endif --}}
        
            <div class="books">
                <div class="row">
                    @if(count($books) > 0)
                        @foreach ($books as $book)
                            <div class="col">
                                @if (\Carbon\Carbon::parse($book->created_at)->diffInDays(\Carbon\Carbon::now()) < 7)
                                    <h3><span class="badge badge-warning new-product">New</span></h3>
                                @endif
                                @if ($book->discount != null)
                                    <h4><span class="badge badge-info discount">{{$book->discount}}&percnt;</span></h4>
                                @endif
                                <a style="text-decoration: none; color: black" href="/book/{{$book->slug}}">
                                    <div class="">
                                        <img class="book-image" src="{{ URL::asset('storage/'.$book->cover) }}">
                                    </div>
                                <div class="book-title">
                                    <h4>{{$book->title}}</h4>
                                </div>
                                @foreach ($book->authors as $author)
                                    <div class="book-author">
                                        <span>{{$author->fullname}}</span>
                                    </div>
                                @endforeach
                                    <div class="book-price">
                                        <b>{{$book->price}} &euro;</b>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        {{$books->links()}}  
                    @endif
                </div>
            </div>
        </div>  
    </div>
@endsection
