@extends('layouts.app')
@section('content')
<div class="container width_modified_container">
    <div class="row mt-4">
        @auth
        @if (!$teachers->where('user_id', Auth::id())->count())
        <div class="container bootstrap snippets bootdeys">
            <div class="row justify-content-center">
                <h1>Completa il tuo profilo qui!</h1>
                <div class="col-md-4 col-sm-6 content-card">
                    <div class="card-big-shadow">
                        <div class="card card-just-text" data-background="color" data-color="green" data-radius="none">
                            <div class="content">
                                <div class="plus title radius">
                                    {{-- CREATE --}}
                                    <a style="text-decoration: none;" href="{{ route('user.create') }}">&#43;</a>
                                </div>
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endauth
        {{-- <a href="{{route('user.create' )}}">CREATE</a> --}}
        @foreach ($teachers as $teacher)
        {{-- VERIFICO SE l'UTENTE E' LOGGATO --}}
        @if (Auth::check())
        {{-- VERIFICO SE l'ID DELL'UTENTE LOGGATO CORRISPONDE ALL'USER ID DEI TEACHER - HA UN PROFILO --}}
        @if (Auth::user()->id == $teacher->user_id)
        {{-- STAMPO I SUOI PROFILI --}}
        <div class="d-flex">
            <div class="col-3 p-2">
                <a href="{{ route('user.show', $teacher->id) }}" class="text-decoration-none">
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
            <div class="d-flex">
                <form id="profileForm" action="{{ route('teacher.edit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $teacher->user->id }}">
                </form>
                <div class="d-flex mt-2 flex-column">
                    <!-- Modifica profilo -->
                    <div class="mt-2">
                        <button type="button" class="btn btn-warning" style="width: 200px"><a
                                style="text-decoration: none; color:black" href="#"
                                onclick="document.getElementById('profileForm').submit(); return false;">MODIFICA
                                PROFILO</a></button>
                    </div>
                    <div>
                        <!-- Cancellazione profilo -->
                        <form class="mt-2" action="{{ route('user.del', $teacher->user->id) }}" method="POST"
                            onsubmit="return confirm('Confermare?');">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger w-100" type="submit" value="CANCELLA" style="color: black">
                        </form>
                    </div>

                    {{-- Aggiungo gli altri 3 bottoni: messaggi, recensioni e sponsorizzazioni --}}
                    <button class="btn btn-primary me-3 mt-2 w-100">
                        <a href="{{ route('user.messages', $teacher->id) }}"
                            style="text-decoration: none; color: white">
                            MESSAGGI
                        </a>
                    </button>
                    <button class="btn btn-success me-3 mt-2 w-100">
                        <a href="{{ route('user.reviews', $teacher->id) }}" style="text-decoration: none; color: white">
                            RECENSIONI
                        </a>
                    </button>
                    <form id="sponsorship-form" method="POST" action="{{ route('user.sponsorship') }}">
                        @csrf
                        <!-- Campo nascosto per l'ID dell'insegnante -->
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        <!-- Bottone per inviare il modulo -->
                        <button class="btn btn-orange w-100 mt-2" type="submit"
                            style="color: white">SPONSORIZZAZIONI</button>
                    </form>


                </div>
            </div>

        </div>

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