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
<div class="row row-cols-2" style="width: 95%;">
    <div class="col-12 col-md-4 col-xl-3">
        <div class="card border-success mb-4 left-profile-card">
            <div class="card-body">
                <div class="text-center">
                    <div class="img_container">
                        <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                    </div>
                    <h2 class="mt-2">{{ $teacher->user->name }} {{ $teacher->user->lastname }}</h2>
                    <p id="teacher">INSEGNANTE</p>
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        @php
                        $maxId = $teacher->ratings->max('id');
                        @endphp

                        @for ($i = 0; $i < count($ratings); $i++) <span class="{{ $i < $maxId ? 'text-danger' : '' }}">
                            <i class="fas fa-star" style="color: rgb(247, 199, 70)"></i></span>
                            @endfor
                    </div>
                </div>
                <div class="personal-info mt-4">
                    <h3>INFORMAZIONI PERSONALI</h3>
                    <ul class="personal-list">
                        <li><i class="fas fa-cake-candles "></i><span id="DateBirth">{{ $teacher->user->date_of_birth
                                }}</span></li>
                        <li><i class="fas fa-map-marker-alt "></i><span>{{ $teacher->user->city }}</span></li>
                        <li><i class="fas fa-briefcase "></i><span>Web Developer</span></li>
                        <li><i class="far fa-envelope "></i><span>{{ $teacher->user->email }}</span></li>
                        <li><i class="fas fa-mobile "></i><span>{{ $teacher->phone_number }}</span></li>
                        <li><i class="fas fa-receipt "></i><span>{{ $teacher->tax_id }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row flex-column flex-grow-1">
        <div class="col">
            <div class="card border-success right-profile-card">
                <div class="card-header border-success" style="font-weight: bold;">
                    ALTRE INFO
                </div>
                <div class="card-body">
                    <h5>BIOGRAFIA</h5>
                    <p class="text_wrap">{{ $teacher->biography }}</p>

                    <h5>MATERIE</h5>
                    <ul>
                        @foreach ($teacher->subjects as $subject)
                        <li>{{ $subject->name }}</li>
                        @endforeach
                    </ul>

                    <h5>MOTTO</h5>
                    <p>{{ $teacher->motto }}</p>

                    <h5>CV</h5>
                    @if (!empty($teacher->cv_url))
                    <a href="{{ route('teacher.index', $teacher->user->id) }}" target="_blank">CV</a>
                    @else
                    CV NON PRESENTE
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    let data_nascita = document.getElementById('DateBirth');

        // DEBUG
        // console.log(data_nascita)

        var dataNascita = new Date(data_nascita.textContent);


        var dataFormattata = `${dataNascita.getDate()}/${dataNascita.getMonth() + 1}/${dataNascita.getFullYear()}`;


        data_nascita.textContent = dataFormattata;
</script>
@endsection