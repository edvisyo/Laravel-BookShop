@extends('layouts.app')

@section('content')

    @if (Auth()->id() != null)
        <book-component v-bind:user_id="{{Auth()->id()}}"></book-component>
    @else
        <book-component></book-component>
    @endif
    
@endsection
    