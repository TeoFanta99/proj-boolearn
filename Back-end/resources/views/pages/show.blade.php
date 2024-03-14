@extends('layouts.app')
@section('head')
    <title>Show</title>
@endsection
@section('content')
    {{-- <img src="{{ asset('storage/' . $project -> image) }}" alt="" width="300px"> --}}
    {{-- @auth
        <a href="{{ route('event.edit', $event -> id) }}">EDIT ME</a>
    @endauth --}}
    <br>
    @if(session('error'))
        <div> {{session('error')}}</div>
    @endif

    <div >
        {{$user->name}}
    </div>

    <div>
        {{$user->lastname}}
    </div>

    <div>
        {{$user->date_of_birth}}
    </div>

    <div>
        {{$user->email}}
    </div>
    {{-- @auth
        <form action="{{route('event.delete' , $event -> id)}}" method="POST">
        
            @csrf
            @method('DELETE')

            <button type="submit">DELETE EVENT</button>
        
        </form>
    @endauth --}}


@endsection