@extends('layouts.app')
@section('content')
<div class="container width_modified_container">
    <div class="row mt-4">
        @auth
        @if (!$teachers->where('user_id', Auth::id())->count())
        {{-- CREATE --}}
        <a href="{{ route('user.create') }}">Crea Profilo</a>
        @endif
        @endauth
        {{-- <a href="{{route('user.create' )}}">CREATE</a> --}}
        @foreach ($teachers as $teacher)
        {{-- VERIFICO SE l'UTENTE E' LOGGATO --}}
        @if (Auth::check())
        {{-- VERIFICO SE l'ID DELL'UTENTE LOGGATO CORRISPONDE ALL'USER ID DEI TEACHER - HA UN PROFILO --}}
        @if (Auth::user()->id == $teacher->user_id)
        {{-- STAMPO I SUOI PROFILI --}}
        <div class="col-3 p-2">
            <a href="{{ route('user.show', $teacher->user->id) }}" class="text-decoration-none">
                <div class="card pt-3 border-0 shadow">
                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                        <img class="object-fit-cover border rounded" style="height: 100%;"
                            src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                    </div>
                    <div class="card-body">
                        <h4>{{ $teacher->user->name }} {{ $teacher->user->lastname }}</h4>
                    </div>
                </div>
            </a>
        </div>
        <a href="{{ route('user.edit', $teacher->user->id) }}">Gestisci Profilo</a>
        <form class="ms-3 d-block" action="{{ route('user.del', $teacher->user->id) }}" method="POST"
            onsubmit="return confirm('Confermare?');">
            @csrf
            @method('DELETE')
            <input type="submit" value="CANCELLA">
        </form>
        @endif
        {{-- SE NESSUNO E' LOGGATO --}}
        @else
        {{-- STAMPA TUTTI --}}
        <div class="col-3 p-2">
            <a href="{{ route('user.show', $teacher->user->id) }}" class="text-decoration-none">
                <div class="card pt-3 border-0 shadow">
                    <div class="d-flex justify-content-center align-items-center img_circle mx-auto"
                        style="height: 250px;">
                        <img class="w-100 h-100 rounded-circle" src="{{ asset('storage/' . $teacher->image_url) }}"
                            alt="">
                    </div>
                    <div class="card-body">
                        <h4>{{ $teacher->user->name }} {{ $teacher->user->lastname }}</h4>
                    </div>
                </div>
            </a>
        </div>
        {{-- <li class="col-3"><a href="{{ route('user.show', $teacher->user->id) }}">{{ $teacher->user->name }}
                {{ $teacher->user->lastname }}</a>

        </li> --}}
        @endif
        @endforeach
    </div>
</div>
@endsection