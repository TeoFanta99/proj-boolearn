<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolearn</title>
    <link rel="icon" href="{{ Vite::asset('public/BL1.svg') }}" type="image/png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            /* colore di sfondo della sidebar */
            color: #fff;
            /* colore del testo della sidebar */
            padding-top: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
            /* colore di sfondo al passaggio del mouse */
        }

        .content {}

        .navbar {
            background-color: #fff;
            /* colore di sfondo della navbar */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* ombra */
        }

        .navbar-brand img {
            height: 30px;
            /* altezza del logo */
        }

        .navbar-toggler-icon {
            background-color: #495057;
            /* colore delle linee del toggler */
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: #343a40;
            /* colore del testo dei link nella navbar */
        }

        .dropdown-menu {
            transition: opacity 1s ease;
        }

        .dropdown-menu.show {
            transition: transform 4s ease;
            /* Applica la transizione solo alla trasformazione */
            left: auto;
            transform: translateX(calc(-100% + 50px));
            /* 50px è la larghezza della sidebar */
            opacity: 1;
            /* Assicurati che l'opacità sia impostata su 1 quando il menu è visualizzato */
        }

        .animate {
            animation-duration: 0.3s;
            -webkit-animation-duration: 0.3s;
            animation-fill-mode: both;
            -webkit-animation-fill-mode: both;
        }

        @keyframes slideIn {
            0% {
                transform: translateY(1rem) translateX(-70%);
                opacity: 0;
            }

            100% {
                transform: translateY(0) translateX(-70%);
                opacity: 1;
            }
        }

        @-webkit-keyframes slideIn {
            0% {
                -webkit-transform: translateY(1rem) translateX(-70%);
                -webkit-opacity: 0;
            }

            100% {
                -webkit-transform: translateY(0) translateX(-70%);
                -webkit-opacity: 1;
            }
        }

        .slideIn {
            -webkit-animation-name: slideIn;
            animation-name: slideIn;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
            /* colore del testo al passaggio del mouse */
        }

        .dashboard-header {
            background-color: #f8f9fa;
            /* colore di sfondo dell'intestazione del dashboard */
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
            /* bordo inferiore */
        }

        .dashboard-title {
            margin-bottom: 0;
        }

        .dashboard-content {
            padding: 20px;
            background-color: #fff;
            /* colore di sfondo del contenuto del dashboard */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* ombra */
        }

        /* Aggiungi altri stili personalizzati per il dashboard qui */
    </style>
</head>

<body class="overflow-hidden">
    <div class="row justify-content-end">
        <div class="sidebar col-2">
            <ul class="row justify-content-center w-100">
                <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                @guest
                    <li><a href="{{ route('login') }}">{{ __('Accedi') }}</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link  d-none d-lg-block" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                            <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Disconnetti') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <!-- Aggiungi altri link della sidebar qui -->
            </ul>
        </div>
        <div class="content col-9">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <div class="logo_header">
                            <img src="{{ Vite::asset('public/BL1.svg') }}" alt="">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse  navbar-collapse flex-grow-0 list-unstyled" id="navbarSupportedContent">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    <img src="{{ asset('storage/' . Auth::user()->teacher->image_url) }}" alt="User Avatar"
                                        class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right slideIn animate"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                                    <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profilo') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Disconnetti') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </div>
                </div>
            </nav>
            <main class="p-5">
                @yield('content')
            </main>
        </div>
    </div>
</body>
<script>
    //  document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function(dropdownToggle) {
    // dropdownToggle.addEventListener('click', function() {
    //     // Seleziona il menu dropdown associato a questo toggle
    //     const dropdownMenu = dropdownToggle.nextElementSibling;

    //     // Aggiungi la classe 'show' al menu dropdown per mostrarlo
    //     dropdownMenu.classList.add('show');

    //     // Applica una transizione di opacità al menu dropdown
    //     dropdownMenu.style.transition = 'opacity 4s all';

    //     // Imposta l'opacità del menu dropdown a 1 dopo un breve ritardo
    //     setTimeout(function() {
    //         dropdownMenu.style.opacity = '1';
    //     }, 2000);
    // });
</script>

</html>
