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
    @if (session('error'))
        <div> {{ session('error') }}</div>
    @endif
        <div class="row">
            <div class="col-4">
                <div>
                    {{ $teacher->user->name }}
                </div>
            
                <div>
                    {{ $teacher->user->lastname }}
                </div>
            
                <div>
                    {{ $teacher->user->date_of_birth }}
                </div>
            
                <div>
                    {{ $teacher->user->email }}
                </div>
               
            </div>
            <div class="col-3">
                <div class="img_container">
                    <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                </div>
            </div>
        </div>
   
    
    {{-- @auth
        <form action="{{route('event.delete' , $event -> id)}}" method="POST">
        
            @csrf
            @method('DELETE')

            <button type="submit">DELETE EVENT</button>
        
        </form>
    @endauth --}}
@endsection
