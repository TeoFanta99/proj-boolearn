@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="row mt-4">
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
                            {{-- VERIFICO SE  l'ID DELL'UTENTE LOGGATO CORRISPONDE ALL'USER ID DEI TEACHER - HA UN PROFILO --}}
                            @if (Auth::user()->id == $teacher->user_id)
                                {{-- STAMPO I SUOI PROFILI  --}}
                                <li>
                                    <a href="{{ route('user.show', $teacher->user->id) }}">{{ $teacher->user->name }}
                                        {{ $teacher->user->lastname }}</a>
                                    <a href="{{ route('user.edit', $teacher->user->id) }}">Gestisci Profilo</a>
                                    <form class="ms-3 d-block" action="{{ route('user.del', $teacher->user->id) }}" method="POST"onsubmit="return confirm('Confermare?');">
                    
                                        @csrf
                                        @method('DELETE')
                    
                                        <input type="submit" value="DELETE">
                                    </form>

                                </li>
                            @endif
                            {{-- SE NESSUNO E' LOGGATO  --}}
                        @else
                            {{-- STAMPA TUTTI --}}
                            <li class="col-3"><a
                                    href="{{ route('user.show', $teacher->user->id) }}">{{ $teacher->user->name }}
                                    {{ $teacher->user->lastname }}</a>

                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
