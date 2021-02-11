@extends('layouts.app')

@section('content')
    <div class="container">
        change fuckn email here

        <br>
        {!! Form::open(['action' => ['App\Http\Controllers\User\UserController@updateEmail', Auth()->user()->id], 'method' => 'POST']) !!}
        {{-- {!! Form::open() !!} --}}
            @csrf
            @method('PUT')
                <div class="form-group">
                    {{Form::label('new_email', 'New Email')}}
                    {{Form::text('new_email', null, ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}

    </div>
@endsection