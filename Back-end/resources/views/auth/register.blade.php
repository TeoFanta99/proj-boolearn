@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="Form_register">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome *') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong> Il Campo <i>Nome</i> &grave; obbligatorio </strong>
                                        </span>
                                    @enderror
                                    <span id="NameNo" class="d-none text-danger"></span>
                                </div>

                            </div>
                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Il Campo <i>Cognome</i> &grave; obbligatorio</strong>
                                        </span>
                                    @enderror
                                    <span id="LastNameNo" class="d-none  text-danger"></span>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Data di
                                                                                                        Nascita *') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}">

                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span id="DateNo" class="d-none  text-danger"> Data di nascita non valida! Devi essere
                                    maggiorenne!</span>
                            </div>

                            <div class="mb-4 row">
                                <label for="city"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Città *') }}</label>

                                <div class="col-md-6">
                                    <select id="city" class="form-control" name="city" value="{{ old('city') }}">
                                        <option value="">Seleziona la tua città</option>
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span id="DateNo" class="d-none  text-danger"> Seleziona una città per continuare!</span>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo Email *') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">
                                    <span id="MailNo" class="d-none  text-danger"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma
                                                                                                        Password *') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <span id="PassNo" class="d-none text-danger">Le password non corrispondono!</span>
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                            <div class="mb-4 row mb-0">
                                <h6>* <i>campi obbligatori</i></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            getCities();

            function populateCitySelect(cities) {
                const select = document.getElementById("city");
                cities.forEach(city => {
                    const option = document.createElement("option");
                    option.value = city.nome;
                    option.textContent = city.nome;
                    select.appendChild(option);
                });
            }

            function getCities() {
                setTimeout(() => {
                    const options = {
                        method: 'GET',
                        headers: {
                            accept: 'application/json'
                        }
                    };

                    axios.get('https://axqvoqvbfjpaamphztgd.functions.supabase.co/comuni', options)
                        .then(response => {
                            const data = response.data;
                            // Controlla se ci sono risultati
                            if (Array.isArray(data) && data.length > 0) {
                                populateCitySelect(data);
                            } else {
                                console.log("Nessuna città trovata.");
                            }
                        })
                        .catch(error => {
                            console.error("Si è verificato un errore:", error);
                        });
                }, 1000);
            }
        });
        document.getElementById("Form_register").addEventListener("submit", function(event) {
            event.preventDefault();

            let name = document.getElementById('name').value;
            let lastname = document.getElementById('lastname').value;
            let password = document.getElementById('password').value;
            let password_confirm = document.getElementById('password-confirm').value;
            let date_of_birth = document.getElementById('date_of_birth').value;
            let email = document.getElementById('email').value;

            console.log(name);

            let validation = 0;
            // DEBUG
            // console.log(email);
            // console.log('pass 1 : ',password);
            // console.log('pass 2 : ',password_confirm);
            // console.log('data: ', date_of_birth);


            validation += checkMatchPass(password, password_confirm);
            validation += checkDateOfBirth(date_of_birth);
            validation += checkEmail(email);
            validation += checkNameLastName(name, lastname);

            // console.log(" valore", validation);
            if (validation == 4) {
                this.submit();
            }

            function checkNameLastName(nome, cognome) {
                // Rimuovi gli spazi vuoti all'inizio e alla fine delle stringhe
                var nomeTrimmed = nome.trim();
                var cognomeTrimmed = cognome.trim();
                let yesOrNo;

                // Verifica se entrambe le stringhe risultanti sono vuote
                if (nomeTrimmed === '' && cognomeTrimmed === '') {
                    // Entrambi i campi sono vuoti
                    document.getElementById('LastNameNo').classList.remove('d-none');
                    document.getElementById('LastNameNo').innerHTML = 'Devi inserire il Cognome!';
                    document.getElementById('NameNo').classList.remove('d-none');
                    document.getElementById('NameNo').innerHTML = 'Devi inserire il Nome!';

                } else if (nomeTrimmed !== '' && cognomeTrimmed === '') {
                    // Solo il nome è inserito
                    document.getElementById('NameNo').classList.add('d-none');
                    document.getElementById('NameNo').innerHTML = '';
                    document.getElementById('LastNameNo').classList.remove('d-none');
                    document.getElementById('LastNameNo').innerHTML = 'Devi inserire il Cognome!';
                } else if (nomeTrimmed === '' && cognomeTrimmed !== '') {
                    // Solo il cognome è inserito
                    document.getElementById('NameNo').classList.add('d-none');
                    document.getElementById('NameNo').innerHTML = '';
                    document.getElementById('LastNameNo').classList.remove('d-none');
                    document.getElementById('LastNameNo').innerHTML = 'Devi inserire il Nome!';

                } else {
                    // Entrambi il nome e il cognome sono inseriti
                    document.getElementById('NameNo').classList.add('d-none');
                    document.getElementById('NameNo').innerHTML = '';
                    document.getElementById('LastNameNo').classList.add('d-none');
                    document.getElementById('LastNameNo').innerHTML = '';
                    yesOrNo = true;
                }
                return yesOrNo;
            }

            function checkEmail(email) {
                let validExtension = false;
                let emailExtensions = ['.net', '.org', '.info', '.edu', '.gov', '.it', '.com'];
                for (let i = 0; i < emailExtensions.length; i++) {
                    if (email.includes(emailExtensions[i])) {
                        validExtension = true;
                        break;
                    }
                }
                if (!validExtension) {
                    document.getElementById('MailNo').classList.remove('d-none');
                    document.getElementById('MailNo').innerHTML = 'Estensione non valida!';
                } else {
                    document.getElementById('MailNo').classList.add('d-none');
                    document.getElementById('MailNo').innerHTML = '';
                }
                return validExtension;
            }

            function checkDateOfBirth(date_of_birth) {
                let yesOrNo;

                let today = new Date();
                let birthDate = new Date(date_of_birth);

                if (birthDate > today) {
                    yesOrNo = false;
                    document.getElementById('DateNo').classList.remove('d-none');
                    document.getElementById('DateNo').innerHTML = 'La data di nascita non può essere nel futuro!';
                } else if (today.getFullYear() - birthDate.getFullYear() < 18) {
                    yesOrNo = false;
                    document.getElementById('DateNo').classList.remove('d-none');
                    document.getElementById('DateNo').innerHTML = 'Devi essere maggiorenne!';
                } else {
                    yesOrNo = true;
                    document.getElementById('DateNo').classList.add('d-none');
                }
                return yesOrNo;
            }

            function checkMatchPass(pass1, pass2) {
                let yesOrNo = true;

                if (pass1.length === 0 || pass2.length === 0) {
                    // Se una delle password è vuota
                    document.getElementById('PassNo').classList.remove('d-none');
                    document.getElementById('PassNo').innerHTML = 'Nessuna password inserita!';
                    yesOrNo = false;
                } else if (pass1 !== pass2) {
                    // Se le password non corrispondono
                    document.getElementById('PassNo').classList.remove('d-none');
                    document.getElementById('PassNo').innerHTML = 'Le password non corrispondono!';
                    yesOrNo = false;
                } else if (pass1.length < 8 || pass2.length < 8) {
                    // Se una delle password è troppo corta
                    document.getElementById('PassNo').classList.remove('d-none');
                    document.getElementById('PassNo').innerHTML = 'La password deve essere almeno di 8 caratteri!';
                    yesOrNo = false;
                } else {
                    // Se tutte le condizioni sono soddisfatte
                    document.getElementById('PassNo').classList.add('d-none');
                }

                return yesOrNo;

            }
        });
    </script>
@endsection
