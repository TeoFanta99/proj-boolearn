@extends('dashboard')

@section('sezione')
    {{-- <img src="{{ asset('storage/' . $project -> image) }}" alt="" width="300px"> --}}
    {{-- @auth
<a href="{{ route('event.edit', $event -> id) }}">EDIT ME</a>
@endauth --}}
    <div class="background_show" id="main">
        <img src="{{ asset('sl_021821_40890_06.jpg') }}" class="w-100 h-100 position-absolute z-index-1" alt=""
            id="sfondo">
        <h1 class="dashboard-title mx-auto">GESTIONE Profilo</h1>
        <br>
        @if (session('error'))
            <div> {{ session('error') }}</div>
        @endif
        <div class="main-content">
            <!-- Top navbar -->


            <!-- Header -->
            <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
                style="min-height: 600px; background-size: cover; background-position: center top;">
                <!-- Mask -->
                <span class="mask bg-gradient-default opacity-8"></span>
                <!-- Header container -->
                <div class="container-fluid d-flex align-items-center">
                    <div class="row justify-content-center w-100">
                        <div class="col-lg-7 col-md-10">
                            <h1 class="display-2 text-white">Ciao {{ $teacher->user->name }}</h1>
                            <p class="text-white mt-0 mb-5">Questa è la tua pagina dove puoi vedere tutte le tue
                                informazioni che saranno visualizzate dall'utente. Se desideri modificarne qualcuno, clicca
                                su *<strong>Modifica Profilo</strong>*</p>
                            <a onclick="submitFormEdit()" class="btn btn-info text-light">Modifica Profilo</a>
                            <form id="EditForm" action="{{ route('teacher.edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $teacher->user->id }}">
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page content -->
            <div class="container mt--7">
                <div class="row">
                    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                        <div class="card card-profile shadow">
                            <div class="row justify-content-center">
                                <div class="col-lg-3 order-lg-2">
                                    <div class="card-profile-image">
                                        <img src="{{ asset('storage/' . $teacher->image_url) }}" class="rounded-circle">
                                    </div>
                                </div>
                            </div>
                            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                <div class="d-flex justify-content-between">

                                </div>
                            </div>
                            <div class="card-body pt-0 pt-md-4">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                            <div>
                                                <span class="heading">{{ $teacher->subjects->count() }}</span>
                                                <span class="description">Materie</span>
                                            </div>
                                            <div>


                                                <span class="heading">{{ number_format($rating, 1) }} <i
                                                        class="fa-solid fa-star"></i></span>
                                                <span class="description">Voti</span>
                                            </div>
                                            <div>
                                                <span class="heading">{{ $teacher->reviews->count() }}</span>
                                                <span class="description">Recensioni</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h3>
                                        {{ $teacher->user->name }} {{ $teacher->user->lastname }}<span
                                            class="font-weight-light"></span>
                                    </h3>
                                    <div class="h5 font-weight-300">
                                        <i class="ni location_pin mr-2"></i>{{ $teacher->user->city }}, Italia
                                    </div>
                                    <div class="h5 mt-4">
                                        <i class="ni business_briefcase-24 mr-2"></i>Insegnante
                                    </div>
                                    <hr class="my-4">
                                    <p>
                                        <i class="ni education_hat mr-2"></i>Materie:
                                    <ul class="list-unstyled">
                                        @foreach ($teacher->subjects as $subject)
                                            <li>
                                                {{ $subject->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">Il mio profilo</h3>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <h6 class="heading-small text-muted mb-4">Informazioni Personali</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-username">Nome</label>
                                                    <input type="text" id="input-username"
                                                        class="form-control form-control-alternative"
                                                        placeholder="{{ $teacher->user->name }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-last-name">Cognome</label>
                                                    <input type="text" id="input-last-name"
                                                        class="form-control form-control-alternative"
                                                        placeholder="{{ $teacher->user->lastname }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-email">Indirizzo
                                                        Mail</label>
                                                    <input type="email" id="input-email"
                                                        class="form-control form-control-alternative"
                                                        placeholder="{{ $teacher->user->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-first-name">Sesso</label>
                                                    <input type="text" id="input-first-name"
                                                        class="form-control form-control-alternative"
                                                        placeholder="{{ $teacher->user->gender == 'male' ? 'Maschio' : 'Femmina' }}"
                                                        disabled>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <!-- Address -->
                                    <h6 class="heading-small text-muted mb-4">Contatti</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-city">Citt&agrave;</label>
                                                    <input id="input-city" class="form-control form-control-alternative"
                                                        placeholder="{{ $teacher->user->city }}" type="text" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input-state">Stato</label>
                                                    <input id="input-state" class="form-control form-control-alternative"
                                                        placeholder="Italia" type="text" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="input_number_phone">Numero di
                                                        Telefono</label>
                                                    <input type="text" id="input_number_phone"
                                                        class="form-control form-control-alternative"
                                                        placeholder="{{ $teacher->phone_number }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group focused">
                                                    @if ($teacher->motto)
                                                        <label class="form-control-label">Motto</label>

                                                        <textarea rows="1" cols="1" class="form-control form-control-alternative h-auto"
                                                            placeholder="{{ $teacher->motto }}" disabled style="height: 40px; resize: none;"></textarea>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <!-- Description -->
                                    <h6 class="heading-small text-muted mb-4">Biografia</h6>
                                    <div class="pl-lg-4">
                                        <div class="form-group focused">

                                            <textarea rows="4" class="form-control form-control-alternative" disabled>{{ $teacher->biography }}</textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                let data_nascita = document.getElementById('DateBirth');
                if (data_nascita) {
                    var dataNascita = new Date(data_nascita.textContent);
                    var dataFormattata =
                        `${dataNascita.getDate()}/${dataNascita.getMonth() + 1}/${dataNascita.getFullYear()}`;
                    data_nascita.textContent = dataFormattata;
                }
            }, 1000); // Ritardo di 1 secondo (1000 millisecondi)
        });
        function submitFormEdit() {
        document.getElementById("EditForm").submit();
    };
    </script>
@endsection
