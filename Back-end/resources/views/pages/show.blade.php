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
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="img_container w-100 h-100">
                    <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                </div>


            </div>
            <div class="col-8">
                <div class="d-flex align-items-center gap-2">
                    <h2>
                        {{ $teacher->user->name }} {{ $teacher->user->lastname }}
                    </h2>
                    <span>{{ $teacher->city }}</span>
                </div>
                <h6>Teacher</h6>

                Ratings

                @php
                    $maxId = $teacher->ratings->max('id');
                @endphp
                
                @for ($i = 0; $i < count($ratings); $i++)
                <span class="{{ $i < $maxId ? 'text-danger' : '' }}">&#9733;</span>
                @endfor


                <div>
                    {{ $teacher->user->date_of_birth }}
                </div>

                <div>
                    {{ $teacher->user->email }}
                </div>
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
