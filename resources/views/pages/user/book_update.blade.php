@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-default mb-4" href="{{ route('user_page') }}">Back</a>
        <h3 class="mb-4 ml-3">Update Book: <strong style="text-transform: capitalize">{{$book->title}}</strong></h3>
        {!! Form::open(['action' => ['App\Http\Controllers\User\UserController@updateBook', $book->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                @method('PUT')
                <div class="col-md-8 order-md-1">
                    <form class="needs-validation" novalidate>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                            {{Form::label('book_title', 'Book title:')}}
                            {{Form::text('book_title', ($book->title), ['class' => 'form-control', 'placeholder' => 'Leave your comment about this book here..'])}}
                          <div class="invalid-feedback">
                            Valid first name is required.
                          </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            {{Form::label('book_status', 'Status:')}}
                            <select class="custom-select d-block w-100" id="book_status" required>                      
                              @if ($book->approved != 1)
                                <option value="2">Not approved</option> 
                              @else
                                <option value="1">Approved</option>
                              @endif
                            </select>
                            <div class="invalid-feedback">
                              Please select a valid country.
                            </div>
                          </div>
                      </div>
          
                      <div class="mb-3">
                        {{Form::label('book_description', 'Book description:')}}
                          {{Form::textarea('book_description', ($book->description), ['class' => 'form-control', 'rows' => 9, 'placeholder' => 'Your report message'])}}
                          <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                          </div>
                      </div>
                      
                      <div class="mb-3">
                        {{Form::label('book_authors', 'Authors:')}}
                          <input type="text" name="book_authors" class="form-control" value="{{  $book->authors  }}" placeholder="John Doe, ....">
                      </div>
                      
                      <div class="mb-3">
                        {{Form::label('book_genres', 'Genres:')}}
                         <input type="text" name="book_genres" class="form-control" value="{{  $book->genres  }}" placeholder="romance, action..">
                      </div>
        
                      <div class="row">
                        <div class="col-md-4 mb-3">
                          {{Form::label('book_price', 'Price:')}} &euro;
                          {{Form::text('book_price', ($book->price), ['class' => 'form-control', 'placeholder' => 'Your report message'])}}
                          <div class="invalid-feedback">
                            Please provide a valid state.
                          </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <div class="form-group">
                            {{Form::label('book_cover', 'Change book cover:')}}
                            {{Form::file('book_cover', null, ['class' => 'form-control'])}}
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col">
                          <img  src="{{ URL::asset($book->cover) }}" alt="User book">
                        </div>
                        
                        <div class="uploaded-image-preview">
                          <div class="mb-3">
                            <span>New Book Image:</span>
                          </div>
                          <img class="uploaded-image-preview-resize mr-3" id="uploadedImage" src="#" alt="your image" />
                        </div>
                        
                      </div>
                      <div class="row justify-content-end mt-5">
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Update Book', ['class' => 'btn btn-outline-dark mr-3'])}}
                    </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection