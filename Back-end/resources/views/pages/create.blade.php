@extends('layouts.app')
@section('content')

<h1>CREATE</h1>
{{-- @auth --}}
<form {{-- action="{{route('event.store')}}" --}} method="POST">

    @csrf
    @method('POST')
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <br>
    <label for="lastname">Lastname:</label>
    <input type="text" id="lastname" name="lastname">
    <br>
    <label for="date_of_birth">Date of birth:</label>
    <input type="date_of_birth" id="date_of_birth" name="date_of_birth">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email">
    <br>
    {{-- @foreach($tags as $tag)
    <div>
        <input type="checkbox" name="tag_id[]" value="{{ $tag -> id }}" id="tag{{ $tag -> id }}">
        <label for="tag{{ $tag -> id }}">{{ $tag -> title }}</label>
        <br>
    </div>
    @endforeach --}}
    <br>
    
    <input type="submit" value="CREA">
    
    </form>
{{-- @endauth --}}
@endsection