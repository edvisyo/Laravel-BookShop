@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="book-container">        
            <div class="books">
                <div class="row">
                    @if(count($books) > 0)
                        @foreach ($books as $book)
                            <div class="col">
                                @if ($book->is_new)
                                <span class="new-product"><span class="badge badge-warning">New</span></span>
                                @endif
                                @if ($book->discount != null)
                                    <span class="discount"><span class="badge badge-info">{{$book->discount}}&percnt;</span></span>
                                @endif
                                <a style="text-decoration: none; color: black" href="/book/{{$book->slug}}">
                                    <div class="">
                                        <img class="book-image" src="{{ URL::asset($book->cover) }}" alt="User book">
                                    </div>
                                <div class="book-title">
                                    <h4>{{$book->title}}</h4>
                                </div>
                                @foreach ($book->authors as $author)
                                    <div class="book-author">
                                        <span>{{$author->fullname}}</span>
                                    </div>
                                @endforeach
                                    @if ($book->discount != null)
                                        <div class="book-old-price">
                                            <b>{{number_format($book->price).","."00"}} &euro;</b>
                                        </div>
                                            <b>{{$book->getPriceWithDiscount()}} &euro;</b>
                                    @else
                                        <b>{{number_format($book->price).","."00"}} &euro;</b>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                {{ $books->links() }}
            </div>
        </div>  
    </div>
@endsection
