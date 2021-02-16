@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Create book page</h3>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\BooksController@store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <div class="form-row">
                <div class="col">
                    {{Form::label('authors', 'Authors (Full-Name)*')}}
                    {{Form::text('authors', null, ['class' => 'form-control'])}}
                </div>
                <div class="col">
                    {{Form::label('genres', 'Genre (should be seperated by comma)* type ID for now')}}
                    {{Form::text('genres', null, ['class' => 'form-control'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price')}}
                {{Form::text('price', null, ['class' => 'form-control'])}}
            </div>
            <div class="form-group">
                {{Form::label('cover', 'Book cover')}}
                {{Form::file('cover', null, ['class' => 'form-control'])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}
    </div>
@endsection