@extends('layouts.app')
@section('content')
    <div class="container width_modified_container">

        <ul class="row mt-4 ">
            @auth
                @if (!$teachers->where('user_id', Auth::id())->count())
                    {{-- CREATE --}}
                    <a href="{{ route('user.create') }}">Crea Profilo</a>
                @endif
            @endauth
            {{-- <a href="{{route('user.create' )}}">CREATE</a> --}}
            @foreach ($teachers as $teacher)
                @php
                    $imageUrl =
                        "https://xsgames.co/randomusers/avatar.php?g={$teacher->user->gender}&random=" . uniqid();
                @endphp
                {{-- VERIFICO SE l'UTENTE E' LOGGATO --}}
                @if (Auth::check())
                    {{-- VERIFICO SE  l'ID DELL'UTENTE LOGGATO CORRISPONDE ALL'USER ID DEI TEACHER - HA UN PROFILO --}}
                    @if (Auth::user()->id == $teacher->user_id)
                        {{-- STAMPO I SUOI PROFILI  --}}

                        <li>
                            <a href="{{ route('user.show', $teacher->user->id) }}">{{ $teacher->user->name }}
                                {{ $teacher->user->lastname }}</a>
                            <a href="{{ route('user.edit', $teacher->user->id) }}">Gestisci Profilo</a>
                            <form class="ms-3 d-block" action="{{ route('user.del', $teacher->user->id) }}"
                                method="POST"onsubmit="return confirm('Confermare?');">

                                @csrf
                                @method('DELETE')

                                <input type="submit" value="DELETE">
                            </form>

                        </li>
                    @endif
                    {{-- SE NESSUNO E' LOGGATO  --}}
                @else
                    {{-- STAMPA TUTTI --}}
                    <div class="col-3 p-2">
                        <a href="{{ route('user.show', $teacher->user->id) }}" class="text-decoration-none">

                            <div class="card pt-3 w-100 border-0 shadow">
                                <div class="d-flex justify-content-center">

                                    <div class="d-flex justify-content-center align-items-center">
                                        <img class="img_circle rounded-circle" src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                                    </div>


                                </div>
                                <div class="card-body">
                                    <h4>{{ $teacher->user->name }} {{ $teacher->user->lastname }} </h4>

                                </div>
                            </div>
                        </a>
                    </div>
                    {{-- <li class="col-3"><a
                                    href="{{ route('user.show', $teacher->user->id) }}">{{ $teacher->user->name }}
                                    {{ $teacher->user->lastname }}</a>

                            </li> --}}
                @endif
            @endforeach
        </ul>


    </div>
@endsection
