@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Create book page</h3>
        <hr>
        {!! Form::open(['action' => 'App\Http\Controllers\Books\BooksController@store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <div class="form-row">
                <div class="col">
                    {{Form::label('authors', 'Authors (Full-Name, should be seperated by comma)*')}}
                    {{Form::text('authors', null, ['class' => 'form-control', 'placeholder' => 'e.g. john doe, ...'])}}
                </div>
                <div class="col">
                    {{Form::label('genres', 'Genre (should be seperated by comma)*')}}
                    {{Form::text('genres', null, ['class' => 'form-control', 'placeholder' => 'e.g. romance, ...'])}}
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
                {{Form::label('book_cover', 'Book cover')}}
                {{Form::file('book_cover', null, ['class' => 'form-control'])}}
            </div>

            <div class="uploaded-image-preview">
                <div class="">
                  <span>Book Cover Image:</span>
                </div>
                <img class="uploaded-image-preview-resize mr-3" id="uploadedImage" src="#" alt="your image" />
              </div>
            <div class="row justify-content-center">
                {{Form::submit('Submit', ['class' => 'btn btn-success custom-submit-button'])}}
            </div>
        {!! Form::close() !!}
    </div>
@endsection