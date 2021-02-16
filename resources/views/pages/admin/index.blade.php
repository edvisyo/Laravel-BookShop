@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h3>Admin page</h3>
    
    <ul class="nav nav-tabs mb-1">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin_email_update') }}">Change email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin_password_update') }}">Change password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('create_new_user') }}">Create new user</a>
        </li>
    </ul>

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
        @if (Count($books) > 0)
            @foreach ($books as $books)
                <tbody>
                    <tr>
                        <th>
                            <a href="/book/{{$books->slug}}">
                            <img class="user-book-image" src="{{ URL::asset('storage/'.$books->cover) }}" alt="User book">
                            </a>
                        </th>
                        <td><p class="genre-name">{{$books->title}}</p></td>
                        <td>{{$books->description}}</td>
                        <td>
                            <ul>
                                @foreach ($books->authors as $author)
                                    <li class="user-books-authors-list">{{$author->fullname}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach ($books->genres as $genre)
                                    <li class="user-books-genres-list genre-name">{{$genre->name}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$books->price}} &euro;</td>
                        <td>
                             @if ($books->approved == 0)
                                    {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@approveBook', $books->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('_method', 'PUT')}}
                                            <input type="hidden" name="set_approve_status" value="1">
                                        {{Form::submit('Approve book', ['class' => 'btn btn-primary btn-sm'])}}
                                    {!! Form::close() !!}
                                @else
                                    <h5><span class="badge badge-success">Book approved</span></h5>
                            @endif
                        </td>
                        <td>
                            <ul>
                                <li><button class="btn btn-warning">Edit</button> </li>
                                <li>
                                    {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@deleteBook', $books->id], 'method' => 'POST']) !!}
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