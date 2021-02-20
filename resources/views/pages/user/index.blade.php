@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>&quot;{{Auth()->user()->email}}&quot; book listing:</h4>
        <br>
        <a href="{{ route('user_change_email') }}">Change Email</a>
        {{-- <a href="user/change-email/{{Auth()->user()->id}}">Change Email</a> --}}
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Authors</th>
                <th scope="col">Genres</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            @if (Count($user_books) > 0)
                @foreach ($user_books as $user_book)
                    <tbody>
                        <tr>
                            <th><img class="user-book-image" src="{{ URL::asset($user_book->cover) }}" alt="User book"></th>
                            <td><p class="genre-name">{{$user_book->title}}</p></td>
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
                                        <li class="user-books-genres-list genre-name">{{$genre->name}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{$user_book->price}} &euro;</td>
                            <td>@if ($user_book->approved == 0)
                                    <h5><span class="badge badge-info">Pending..</span></h5>
                                @else
                                    <h5><span class="badge badge-success">Book approved</span></h5>
                                @endif
                            </td>
                            <td>
                                <ul>
                                    <li><button class="btn btn-warning">Edit</button></li>
                                    <li>
                                        {!! Form::open(['action' => ['App\Http\Controllers\User\UserController@deleteBook', $user_book->id], 'method' => 'POST']) !!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
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