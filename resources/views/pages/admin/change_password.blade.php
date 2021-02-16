@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="back-link">
            <a class="btn btn-default mb-4" href="{{ route('admin_page')}}">Back</a>
        </div>
        <h3 class="mb-4">Change password:</h3>
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\AdminController@updatePassword', Auth()->user()->id], 'method' => 'POST']) !!}
            @csrf
            @method('PUT')
                <div class="form-group">
                    {{Form::label('new_password', 'New Password')}}
                    {{Form::text('new_password', null, ['class' => 'form-control'])}}
                </div>
                {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
        {!! Form::close() !!}
    </div>
@endsection