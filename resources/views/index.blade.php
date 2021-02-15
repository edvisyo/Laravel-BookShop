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
                                <a href="/book/{{$book->slug}}">
                                    <img class="book-image" src="{{ URL::asset('storage/'.$book->cover) }}">
                                </a>
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
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        {{-- {{ $books->links() }} --}}
    </div>
@endsection
