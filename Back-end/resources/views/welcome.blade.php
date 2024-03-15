@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="row mt-4">
                    <a href="{{route('user.create' )}}">CREATE</a>
                    @foreach ($teachers as $teacher)
                        {{-- VERIFICO SE l'UTENTE E' LOGGATO --}}
                        @if (Auth::check())
                            {{-- VERIFICO SE  l'ID DELL'UTENTE LOGGATO CORRISPONDE ALL'USER ID DEI TEACHER - HA UN PROFILO --}}
                            @if (Auth::user()->id == $teacher->user_id)
                                {{-- STAMPO I SUOI PROFILI  --}}
                                <li>
                                    {{ $teacher->user->name }}
                                    {{ $teacher->user->lastname }}


                                </li>
                            @endif
                            {{-- SE NESSUNO E' LOGGATO  --}}
                        @else
                            {{-- STAMPA TUTTI --}}
                            <li class="col-3"><a href="{{route('user.show' , $teacher->user->id)}}">{{ $teacher->user->name }}
                                {{ $teacher->user->lastname }}</a>
                               
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
