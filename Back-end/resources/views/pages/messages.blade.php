@extends('dashboard')

@section('sezione')
    <div class="background_show" id="main">
        <img src="{{ asset('sl_021821_40890_06.jpg') }}" class="w-100 h-100 position-absolute z-index-1" alt=""
            id="sfondo">
        <h1 class="dashboard-title">MESSAGGI</h1>
        <br>
        @if (session('error'))
            <div> {{ session('error') }}</div>
        @endif
        <div class="main-content">
            <!-- Top navbar -->


            <!-- Header -->
            {{-- <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
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
                      <a href="#!" class="btn btn-info">Modifica Profilo</a>
                  </div>
              </div>
          </div>
      </div> --}}
            <!-- Page content -->
            @if($messages != null)
            <div class="container-fluid mt-2 pb-4 altezza_contenitore overflow-hidden">
                <div class="row mx-auto margine_row w_95 h-100">
                    
                    <div class="col-3 overflow-y-scroll h-100">
                        @foreach ($messages as $message)
                            <div class="col-12 small-column" data-user_message_id="{{ $message->id }}">
                                <div class="card bg-secondary shadow">
                                    <div class="card-header bg-white border-0">
                                        <div class="d-flex align-items-center justify-content-between h-100">
                                            <h4 class="mb-0">{{ $message->user_name }}</h4>
                                            @php
                                                $date_parts = explode(' ', $message->date_of_message);
                                                $date_only = $date_parts[0];
                                                $hour_only = $date_parts[1];
                                                // Ottieni il fuso orario corrente
                                                $fusoOrario = date_default_timezone_get();

                                                // Ottieni la data e l'ora correnti nel fuso orario corrente
$oraCorrente = new DateTime($hour_only, new DateTimeZone($fusoOrario));
$dataCorrente = new DateTime($date_only, new DateTimeZone($fusoOrario));
$hour_only = $oraCorrente->format('H:i');
$date_only = $dataCorrente->format('d-m-Y');
                                                // dd($hour_only);
                                            @endphp
                                            <h6 class="mb-0">{{ $date_only }} {{ $hour_only }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="col-9 order-xl-1 mx-auto large-column d-none h-100">
                        <div class="card bg-secondary shadow h-100">
                            <div class="card-body h-100">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-object">Oggetto
                                                del
                                                messaggio</label>
                                            <input type="text" id="input-object"
                                                class="form-control form-control-alternative" placeholder="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-user-mail">Email di
                                                Contatto</label>
                                            <input type="email" id="input-user-mail"
                                                class="form-control form-control-alternative"
                                                placeholder="" disabled>
                                        </div>
                                    </div>

                                </div>
                                <hr class="my-4">
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">Messaggio</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group focused">
                                        <textarea rows="4" class="form-control form-control-alternative" id="input-user-message" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var smallColumns = document.querySelectorAll('.small-column');
            var largeColumn = document.querySelector('.large-column');
            smallColumns.forEach(function(column) {
                column.addEventListener('click', function() {
                    var messageId = this.getAttribute('data-user_message_id');
                    var messages = [
                        @foreach ($messages as $message)
                            {
                                id: "{{ $message->id }}",
                                email: '{{ $message->user_email }}',
                                object: '{{ $message->email_title }}',
                                message: '{{ $message->description }}'

                                // Altri dettagli del messaggio...
                            },
                        @endforeach
                    ];
                    // Cerca il messaggio corrispondente nell'array messages
                    var message = messages.find(function(msg) {
                        return msg.id === messageId;
                    });

                    // DEBUG
                    console.log(message);
                    document.getElementById('input-object').value = message.object;
                    document.getElementById('input-user-mail').value = message.email;
                    // document.getElementById('input-last-name').value = message.date;
                    document.getElementById('input-user-message').textContent = message.message;

                    document.querySelector('.large-column').classList.remove('d-none');
                });
            });
        });
    </script>
@endsection
<style>
    .margine_row{
        margin-top: 4rem;
    }

    .w_95 {
        width: 95%;
        
    }
    .altezza_contenitore{
        height: 380px;
    }
</style>
