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
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
            <div class="col p-5">
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
            <div class="col p-5">
                
                <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="image teacher">
                
            </div>

            <div class="col p-5">

                <!-- Imposto un collegamento al pdf del docente -->
                <a href="{{URL::to('storage/' . $teacher->cv_url)}}">

                    <!-- carico logo pdf -->
                    <img src="{{ Vite::asset('public/storage/images/logo_pdf.jpg') }}" class="logo_pdf" alt="cv teacher">

                </a>
       
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
