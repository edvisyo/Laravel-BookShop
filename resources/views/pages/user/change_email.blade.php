@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['action' => ['App\Http\Controllers\User\UserController@changeEmail', Auth()->user()->id], 'method' => 'POST']) !!}
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