@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="{{ route('user_page')}}">Back</a>
        </div>
        {!! Form::open(['action' => ['App\Http\Controllers\User\UserController@changePassword', Auth()->user()->id], 'method' => 'POST']) !!}
            @csrf
            @method('PUT')
                <div class="form-group">
                    {{Form::label('password', 'New Password')}}
                    {{Form::text('password', null, ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}
    </div>
@endsection