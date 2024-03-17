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
    <div class="container mb-4">
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

                <div class="col-6">
                    <h5 class="mt-4 border-bottom"> Materie</h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-3 align-items-center">
                            <ul>
                                @foreach ($teacher->subjects as $subject)
                                    <li>{{$subject->name}}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <h5 class="mt-4 border-bottom"> Biografia</h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-3 align-items-center">
                            <p>{{$teacher->biography}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="mt-2 border-bottom"> Anagrafica</h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-2 align-items-center">
                            <h6 class="mb-0">Data di nascita: </h6>
                            <span id="DateBirth">{{ $teacher->user->date_of_birth }}</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="mb-0">Indirizzo Mail: </h6>
                            <span>{{ $teacher->user->email }}</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="mb-0">Partita Iva: </h6>
                            <span>{{ $teacher->tax_id }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="mt-4 border-bottom"> Contatti</h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-5">
                            <h6>Telefono: </h6>
                            <span>{{ $teacher->phone_number }}</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center">
                            <h6 class="mb-0">Indirizzo Mail: </h6>
                            <span>{{ $teacher->user->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="mt-4 border-bottom"> Motto</h5>
                    <div class="d-flex flex-column">
                        <div class="d-flex gap-5">
                            
                            <span>{{ $teacher->motto }}</span>
                        </div>
                       
                    </div>
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
    <script>
        let data_nascita = document.getElementById('DateBirth');

        // DEBUG
        // console.log(data_nascita)

            var dataNascita = new Date(data_nascita.textContent);

            
            var dataFormattata = `${dataNascita.getDate()}/${dataNascita.getMonth() + 1}/${dataNascita.getFullYear()}`;

            
            data_nascita.textContent = dataFormattata;
        
    </script>
@endsection
