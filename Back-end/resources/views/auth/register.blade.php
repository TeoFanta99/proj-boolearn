@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" id="FormRegistrazione" action="{{ route('register') }}" id="Form_register">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome *') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-4 row">
                                <label for="lastname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo Email *') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                        <span id="MailNo" class="d-none  text-danger"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Data di Nascita *') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}" required>

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
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password *') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <span id="PassNo" class="d-none text-danger">Le password non corrispondono!</span>
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
        document.getElementById("FormRegistrazione").addEventListener("submit", function(event) {
            event.preventDefault();
            let password = document.getElementById('password').value;
            let password_confirm = document.getElementById('password-confirm').value;
            let date_of_birth = document.getElementById('date_of_birth').value;
            let email = document.getElementById('email').value;
            
            
            
            let validation = 0;
            // DEBUG
            // console.log(email);
            // console.log('pass 1 : ',password);
            // console.log('pass 2 : ',password_confirm);
            // console.log('data: ', date_of_birth);
            
            
            validation += checkMatchPass(password, password_confirm);
            validation += checkDateOfBirth(date_of_birth);
            validation += checkEmail(email);
            
            // console.log(" valore", validation);
            if (validation == 3) {
                this.submit();
            }

            function checkEmail(email) {
                let yesOrNo;
                let emailExtensions = ['.com', '.net', '.org', '.info', '.edu', '.gov', '.it'];
                emailExtensions.forEach(element => {
                    // Debug
                    // console.log(email.includes(element));
                    if (email.includes(element)) {
                        yesOrNo = true;
                        document.getElementById('MailNo').classList.add('d-none');
                        document.getElementById('MailNo').innerHTML='';
                    }
                    else{
                        yesOrNo = false;
                        document.getElementById('MailNo').classList.remove('d-none');
                        document.getElementById('MailNo').innerHTML='Estensione non valida!';
                    }
                });
                return yesOrNo;
            }

            function checkDateOfBirth(date_of_birth) {
                let yesOrNo;

                if (new Date().getFullYear() - new Date(date_of_birth).getFullYear() < 18) {
                    // console.log('eh no');
                    yesOrNo = false;
                    document.getElementById('DateNo').classList.remove('d-none');
                } else {
                    yesOrNo = true;
                    document.getElementById('DateNo').classList.add('d-none');
                }
                return yesOrNo;
            }

            function checkMatchPass(pass1, pass2) {
                let yesOrNo;
                if (!pass1.length == 0 || !pass2.length == 0) {
                    if (pass1 == pass2) {
                        // console.log('matchano');
                        yesOrNo = true;
                        document.getElementById('PassNo').classList.add('d-none');
                    }   else {
                        document.getElementById('PassNo').classList.remove('d-none');
                        document.getElementById('PassNo').innerHTML = 'Le password non corrispondono!';
                        yesOrNo = false;
                    }
                    if (pass1.length < 8 && pass2.length < 8) {
                        // DEBUG
                        // console.log('piccola');
                        document.getElementById('PassNo').classList.remove('d-none');
                        document.getElementById('PassNo').innerHTML =
                            'La password deve essere almeno di 8 caratteri!';
                    }
                } else {
                    document.getElementById('PassNo').classList.remove('d-none');
                    document.getElementById('PassNo').innerHTML = 'Nessuna password inserita!';
                    // console.log('campo vuoto');
                    yesOrNo = false;
                }
                return yesOrNo;
            }
        });
    </script>
@endsection
