@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="{{ route('admin_page')}}">Back</a>
        </div>
        <h3 class="mb-4">Create new user:</h3>
        {!! Form::open(['action' => 'App\Http\Controllers\Admin\AdminController@createNewUser', 'method' => 'POST']) !!}
                <div class="form-row">
                    <div class="form-group col-md-3">
                        {{ Form::label('user_role', 'User permission') }}
                        {{ Form::select('user_role', $roles, null, array('class'=>'form-control', 'placeholder'=>'Please select permission...')) }}
                    </div>
                    <div class="form-group col-md-3">
                        {{Form::label('birthdate', 'Date of birth')}}
                        {{Form::date('birthdate', null, ['class' => 'form-control'])}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('email', 'Email')}}
                    {{Form::email('email', null, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('password', 'Password')}}
                    {{Form::password('password', ['class' => 'form-control'])}}
                </div>
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}
    </div>
@endsection