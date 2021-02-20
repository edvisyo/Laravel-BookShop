@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="{{ route('admin_page')}}">Back</a>
        </div>
        <h3 class="mb-4">Change email:</h3>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@updateEmail', Auth()->user()->id], 'method' => 'POST']) !!}
            @csrf
            @method('PUT')
                <div class="form-group">
                    {{Form::label('email', 'New Email')}}
                    {{Form::text('email', null, ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}
    </div>
@endsection