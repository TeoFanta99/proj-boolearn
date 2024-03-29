<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
</head>
<style>
    .menu li a.active {
        color: red;
        /* Cambia il colore del testo in rosso */
    }
</style>

<body class="overflow-hidden">

    <div class="hide"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <symbol viewBox="-167.4 267.7 257.7 257.7" id="facebook">
                <path
                    d="M76.1 267.7h-229.3c-7.9 0-14.2 6.4-14.2 14.2v229.3c0 7.9 6.4 14.2 14.2 14.2h123.4v-99.8h-33.6v-38.9h33.6V358c0-33.3 20.3-51.4 50-51.4 14.2 0 26.5 1.1 30 1.5v34.8H29.6c-16.1 0-19.3 7.7-19.3 18.9v24.8h38.5l-5 38.9H10.4v99.8h65.7c7.9 0 14.2-6.4 14.2-14.2V281.9c0-7.8-6.4-14.2-14.2-14.2z" />
            </symbol>
            <symbol viewBox="-211.1 354.7 82.6 84.9" id="googleplus">
                <path
                    d="M-167.5 403.2l-4-3.1c-1.2-1-2.9-2.3-2.9-4.8 0-2.4 1.7-4 3.1-5.4 4.6-3.7 9.3-7.5 9.3-15.7 0-8.4-5.3-12.9-7.8-15h6.8l7.2-4.5h-21.8c-6 0-14.6 1.4-20.9 6.6-4.8 4.1-7.1 9.8-7.1 14.8 0 8.6 6.6 17.4 18.3 17.4 1.1 0 2.3-.1 3.5-.2-.5 1.3-1.1 2.4-1.1 4.3 0 3.4 1.8 5.5 3.3 7.5-5 .3-14.3.9-21.1 5.1-6.5 3.9-8.5 9.5-8.5 13.5 0 8.2 7.7 15.8 23.8 15.8 19 0 29.1-10.5 29.1-20.9.1-7.5-4.4-11.3-9.2-15.4zm-14.5-12.7c-9.5 0-13.8-12.3-13.8-19.7 0-2.9.5-5.9 2.4-8.2 1.8-2.2 4.9-3.7 7.7-3.7 9.2 0 13.9 12.4 13.9 20.4 0 2-.2 5.5-2.8 8.1-1.7 1.7-4.6 3.1-7.4 3.1zm.1 44.5c-11.8 0-19.5-5.7-19.5-13.5 0-7.9 7.1-10.5 9.5-11.4 4.6-1.6 10.6-1.8 11.6-1.8 1.1 0 1.7 0 2.5.1 8.4 6 12.1 9 12.1 14.6.1 6.9-5.6 12-16.2 12zm42.3-44.7v-11.1h-5.5v11.1h-11v5.5h11V407h5.5v-11.2h11.1v-5.5" />
            </symbol>
            <symbol viewBox="62.4 152.4 487.2 487.2" id="instagram">
                <path
                    d="M493.4 358.5H451c3.1 12 4.9 24.5 4.9 37.5 0 82.8-67.1 149.9-149.9 149.9S156.1 478.8 156.1 396c0-13 1.8-25.5 4.9-37.5h-42.4v206.1c0 10.3 8.4 18.7 18.7 18.7h337.3c10.3 0 18.8-8.4 18.8-18.7V358.5zm0-131.2c0-10.3-8.4-18.7-18.8-18.7h-56.2c-10.3 0-18.7 8.4-18.7 18.7v56.2c0 10.3 8.4 18.7 18.7 18.7h56.2c10.3 0 18.8-8.4 18.8-18.7v-56.2zm-187.4 75c-51.7 0-93.7 41.9-93.7 93.7 0 51.7 41.9 93.7 93.7 93.7 51.7 0 93.7-42 93.7-93.7 0-51.8-42-93.7-93.7-93.7m187.4 337.3H118.6c-31 0-56.2-25.2-56.2-56.2V208.6c0-31 25.2-56.2 56.2-56.2h374.8c31 0 56.2 25.2 56.2 56.2v374.7c0 31.1-25.2 56.3-56.2 56.3" />
            </symbol>
            <symbol viewBox="0 0 512 512" id="sponsorship">
                <path
                    d="M326.7 403.7c-22.1 8-45.9 12.3-70.7 12.3s-48.7-4.4-70.7-12.3c-.3-.1-.5-.2-.8-.3c-30-11-56.8-28.7-78.6-51.4C70 314.6 48 263.9 48 208C48 93.1 141.1 0 256 0S464 93.1 464 208c0 55.9-22 106.6-57.9 144c-1 1-2 2.1-3 3.1c-21.4 21.4-47.4 38.1-76.3 48.6zM256 84c-11 0-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V312c0 11 9 20 20 20s20-9 20-20V298.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V104c0-11-9-20-20-20zM48 352H64c19.5 25.9 44 47.7 72.2 64H64v32H256 448V416H375.8c28.2-16.3 52.8-38.1 72.2-64h16c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V400c0-26.5 21.5-48 48-48z" />
            </symbol>
            <symbol viewBox="-326.8 274.8 63.7 64.5" id="person">
                <path
                    d="M-282.1 306.7l-2.5-1.1 1.8-2.1c2.6-3.1 4.1-6.9 4.1-10.9v-1.2c0-9.2-7.5-16.8-16.8-16.8h-1.2c-9.2 0-16.8 7.6-16.8 16.8v1.2c0 4.2 1.6 8.3 4.6 11.5l1.9 2-2.5 1.2c-10.7 5.1-17.6 16.1-17.6 27.9 0 2.2 1.8 4.1 4.1 4.1s4.1-1.8 4.1-4.1c0-12.5 10.2-22.8 22.8-22.8.2 0 .4 0 .6-.1l.3-.1.3.1c.3 0 .5.1.6.1 12.5 0 22.8 10.2 22.8 22.8 0 2.2 1.8 4.1 4.1 4.1 2.2 0 4.1-1.8 4.1-4.1.1-12.5-7.3-23.6-18.8-28.5zm-4.7-14.4v.4c0 4.7-3.9 8.6-8.6 8.7h-.8c-4.8 0-8.6-3.9-8.6-8.7v-1.2c0-2.3.9-4.5 2.5-6.1 1.6-1.6 3.8-2.5 6.1-2.5h1.2c4.8 0 8.6 3.9 8.6 8.7v.6l-.4.1z" />
            </symbol>


            <symbol viewBox="-232.1 369.1 41.9 54.2" id="pinterest">
                <path
                    d="M-209.8 369.1c-14.8 0-22.2 10.6-22.2 19.4 0 5.4 2 10.1 6.4 11.9.7.3 1.4 0 1.6-.8.1-.5.5-1.9.6-2.5.2-.8.1-1.1-.4-1.7-1.3-1.5-2.1-3.4-2.1-6.1 0-7.9 5.9-14.9 15.3-14.9 8.4 0 12.9 5.1 12.9 11.9 0 9-4 16.5-9.9 16.5-3.3 0-5.7-2.7-4.9-6 .9-3.9 2.7-8.2 2.7-11 0-2.5-1.4-4.7-4.2-4.7-3.3 0-6 3.4-6 8.1 0 2.9 1 4.9 1 4.9l-4 17c-1.2 5-.2 11.2-.1 11.8 0 .4.5.5.7.2.3-.4 4.3-5.3 5.6-10.2.4-1.4 2.2-8.6 2.2-8.6 1.1 2.1 4.2 3.9 7.6 3.9 10 0 16.8-9.1 16.8-21.3.1-9.2-7.8-17.8-19.6-17.8z" />
            </symbol>
            <symbol viewBox="-323.2 278.2 56.3 57.6" id="share">
                <path
                    d="M-276.9 315.6c-2.6 0-5 1-6.8 2.6l-19.3-9.9c.1-.5.1-1 .1-1.5v-.9l19.5-9.9c1.8 1.5 4 2.4 6.5 2.4 5.6 0 10.1-4.5 10.1-10.1s-4.5-10.1-10.1-10.1-10.1 4.5-10.1 10.1v.9l-19.5 9.9c-1.8-1.5-4-2.4-6.6-2.4-5.6 0-10.1 4.5-10.1 10.1s4.5 10.1 10.1 10.1c2.3 0 4.3-.7 6-2l20 10.2v.5c0 5.6 4.5 10.1 10.1 10.1s10.1-4.5 10.1-10.1c.1-5.5-4.5-10-10-10z" />
            </symbol>
            <symbol viewBox="0 137.8 612 516.4" id="speech-bubble">
                <path
                    d="M549.7 199.1v324.2h-63.4L415.6 594l-66.5-70.7H61.3V199.1h488.4m0-61.3H61.3C27 137.8 0 165.9 0 199.1v324.2c0 34.3 28.1 61.3 61.3 61.3h261.8l48.8 50.9c11.4 12.5 27 18.7 43.6 18.7h1c16.6 0 32.2-6.2 43.6-17.7l52-52h38.4c34.3 0 61.3-28.1 61.3-61.3V199.1c-.8-34.3-27.9-61.3-62.1-61.3z" />
            </symbol>

            <symbol viewBox="0 0 512 512" id="messages">

                <path
                    d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z" />

            </symbol>

        </svg></div>

    <div class="d-flex">
        <header class="main-head">
            <nav class="head-nav h-100">
                <ul class="menu d-flex flex-column h-100">
                    <li>
                        <a href="{{ route('dashboard') }}"><img src="{{ asset('/BL1.svg') }}" style="width:40px;"
                                alt=""></a>
                    </li>
                    <li>
                        <a onclick="submitFormShow()" class="text-decoration-none"
                            class="{{ Request::is('about') ? 'active' : '' }}">
                            <svg class="person">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#person"></use>
                            </svg><span class=" d-none d-lg-block" >Profilo</span>
                        </a>

                        <form id="ShowForm" action="{{ route('user.show') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </form>
                    </li>
                    <li>
                        <a onclick="submitFormMessages()" class="text-decoration-none">
                            <svg class="video-player">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#messages"></use>
                            </svg><span class=" d-none d-lg-block">Messaggi</span>
                        </a>
                        <form id="MessageForm" action="{{ route('user.messages') }}" method="POST"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </form>

                    </li>
                    <li>
                        <a onclick="submitFormReviews()" class="text-decoration-none">
                            <svg class="speech-bubble">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#speech-bubble"></use>
                            </svg><span class=" d-none d-lg-block">Recensioni</span></a>
                        <form id="ReviewForm" action="{{ route('user.reviews') }}" method="POST"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </form>
                    </li>
                    <li>
                        <a onclick="submitFormSponsorships()" class="text-decoration-none">
                            <svg class="paper-airplane">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#sponsorship"></use>
                            </svg><span class=" d-none d-lg-block">Sponsorizzazioni</span></a>
                            <form id="SponsorshipForm" action="{{ route('user.sponsorship') }}" method="POST"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        </form>
                    </li>
                    <li class="mt-auto mb-4">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('storage/' . Auth::user()->teacher->image_url) }}" alt="User Avatar"
                                class="rounded-circle mx-auto" style="width: 40px; height: 40px; margin-right: 10px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right slideIn animate" aria-labelledby="navbarDropdown">
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
                </ul>
            </nav>
        </header>
        <div class="wrap-all-the-things">
            @yield('sezione')


        </div>

    </div>


</body>
<script>
    let dropdownOpen = false;

    // Funzione per gestire il dropdown
    function toggleDropdown() {
        const dropdownMenu = document.querySelector('.dropdown-menu');
        if (!dropdownOpen) {
            dropdownMenu.classList.add('animate__slideIn');
            dropdownMenu.classList.add('animate');
            dropdownMenu.classList.add('show');
        } else {
            dropdownMenu.classList.remove('animate__slideIn');
            dropdownMenu.classList.remove('animate');
            dropdownMenu.classList.remove('show');
        }
        dropdownOpen = !dropdownOpen; // Inverti lo stato del dropdown
    }

    // Aggiungi un gestore di eventi al toggle del dropdown
    const dropdownToggle = document.getElementById('navbarDropdown');
    dropdownToggle.addEventListener('click', toggleDropdown);

    // Chiudi il dropdown quando il cursore esce dall'area del dropdown
    const dropdownMenu = document.querySelector('.dropdown-menu');
    dropdownMenu.addEventListener('mouseleave', function() {
        dropdownMenu.classList.remove('animate__slideIn');
        dropdownMenu.classList.remove('animate');
        dropdownMenu.classList.remove('show');
        dropdownOpen = false; // Chiudi il dropdown quando il cursore esce
    });

    function submitFormShow() {
        document.getElementById("ShowForm").submit();
    };
    function submitFormReviews() {
        document.getElementById("ReviewForm").submit();
    };
    function submitFormSponsorships() {
        document.getElementById("SponsorshipForm").submit();
    };

    function submitFormMessages() {
        document.getElementById("MessageForm").submit();
    };
</script>

</html>
