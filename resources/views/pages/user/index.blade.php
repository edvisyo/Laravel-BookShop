@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>&quot;{{Auth()->user()->email}}&quot; knygu sarasas:</h4>
        <br>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Authors</th>
                <th scope="col">Genres</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            @if (Count($user_books) > 0)
                @foreach ($user_books as $user_book)
                    <tbody>
                        <tr>
                            <th><img class="user-book-image" src="{{ URL::asset('storage/'.$user_book->cover) }}" alt="User book"></th>
                            <td>{{$user_book->title}}</td>
                            <td>{{$user_book->description}}</td>
                            <td>
                                <ul>
                                    @foreach ($user_book->authors as $author)
                                        <li class="user-books-authors-list">{{$author->fullname}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach ($user_book->genres as $genre)
                                        <li class="user-books-genres-list">{{$genre->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$user_book->price}} &euro;</td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
                @else
                <div class="alert alert-info" role="alert"  style="text-align: center">
                    <strong>There is no book to show related to your account yet</strong>
                </div>
            @endif
          </table>
    </div>
@endsection