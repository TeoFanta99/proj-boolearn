@extends('dashboard')
@section('sezione')
    <div class="background_show " id="main">
        <img src="{{ asset('sl_021821_40890_06.jpg') }}" class="w-100 h-100 position-absolute z-index-1" alt=""
            id="sfondo">
        <h1 class="dashboard-title">Sponsorizzazioni</h1>
        <br>
        @if (session('error'))
            <div> {{ session('error') }}</div>
        @endif

        <div class="main-content ps-4 overflow-hidden w_95 d-flex flex-column gap-4">
            <div class="col-6">
                Se desideri aggiungere una nuova sponsorizzazione, clicca <button id="payment_form_active"
                    class="btn btn-success p-2 rounded-pill">Qui</button>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="mb-0">Sponsorizzazione Attive</h4 class="mb-0">
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if (!$sponsorships->isEmpty())
                                <ul class="list-unstyled row">
                                    @foreach ($sponsorships as $sponsorship)
                                        <li>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content d-flex align-items-center gap-5 p-2">
                                                        <h4 class="card-title mb-0">{{ $sponsorship->name }}</h4>
                                                        <div class="col-md-6">
                                                            <h4>Data di inizio:
                                                                {{ date('d-m-Y', strtotime($sponsorship->pivot->start_date)) }}
                                                            </h4>
                                                            <h4>Data di fine:
                                                                {{ date('d-m-Y', strtotime($sponsorship->pivot->expire_date)) }}
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-6">

                                                            @php
                                                                $oraCorrente = now()->format('Y-m-d H:i:s');
                                                                $diff_seconds =
                                                                    strtotime($sponsorship->pivot->expire_date) -
                                                                    strtotime($oraCorrente);
                                                                $diff_hours = floor($diff_seconds / 3600);
                                                                $oreMancanti = max($diff_hours, 0); // Assicurati che il numero di ore mancanti sia sempre positivo

                                                                // Se le ore rimanenti superano 24, aggiungi 1 giorno
                                                                $giorniMancanti = 0;
                                                                if ($oreMancanti > 24) {
                                                                    $giorniMancanti = floor($oreMancanti / 24);
                                                                    $oreMancanti -= $giorniMancanti * 24;
                                                                }

                                                                // Formatta la stringa per i giorni
                                                                $stringaGiorni = '';
                                                                if ($giorniMancanti >= 1) {
                                                                    $stringaGiorni = $giorniMancanti . ' giorno';
                                                                    if ($giorniMancanti > 1) {
                                                                        $stringaGiorni = str_replace(
                                                                            'giorno',
                                                                            'giorni',
                                                                            $stringaGiorni,
                                                                        );
                                                                    }
                                                                    $stringaGiorni .= ' e';
                                                                }
                                                                $minutiMancanti = floor(($diff_seconds % 3600) / 60);

                                                            @endphp

                                                            @if ($giorniMancanti > 0)
                                                                <h4>Tempo rimanente: {{ $stringaGiorni }}
                                                                    {{ $oreMancanti }} ore e {{ $minutiMancanti }} minuti
                                                                </h4>
                                                            @else
                                                                <h4>Tempo rimanente: {{ $oreMancanti }} ore e
                                                                    {{ $minutiMancanti }} minuti</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <h4>Non hai sponsorizzazioni attive! Se vuoi farne una clicca qui </h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if ($sponsor_vecchie)
                <div class="accordion my-4" id="accordionExample">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Sponsorizzazioni Passate
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <ul class="list-unstyled row">
                                    @foreach ($sponsorships_delayed as $sponsorship)
                                        <li>
                                            <div class="col-12 mb-4">
                                                <div class="card">
                                                    <div class="card-content d-flex align-items-center gap-5 p-2">
                                                        <h4 class="card-title mb-0">{{ $sponsorship->name }}</h4>
                                                        <div class="col-md-6">
                                                            <h4>Data di inizio:
                                                                {{ date('d-m-Y', strtotime($sponsorship->pivot->start_date)) }}
                                                            </h4>
                                                            @php
                                                                $oraCorrente = now()->format('Y-m-d H:i:s');
                                                                $expire_date = strtotime(
                                                                    $sponsorship->pivot->expire_date,
                                                                );
                                                            @endphp

                                                            <h4>Data di fine: {{ date('d-m-Y', $expire_date) }}</h4>

                                                        </div>
                                                        <div class="col-md-6">
                                                            @php
                                                                $diff_seconds = $expire_date - strtotime($oraCorrente);
                                                                $diff_hours = floor($diff_seconds / 3600);
                                                                $oreMancanti = max($diff_hours, 0); // Assicurati che il numero di ore mancanti sia sempre positivo

                                                                // Se le ore rimanenti superano 24, aggiungi 1 giorno
                                                                $giorniMancanti = 0;
                                                                if ($oreMancanti > 24) {
                                                                    $giorniMancanti = floor($oreMancanti / 24);
                                                                    $oreMancanti -= $giorniMancanti * 24;
                                                                }

                                                                // Formatta la stringa per i giorni
                                                                $stringaGiorni =
                                                                    $giorniMancanti > 0
                                                                        ? ($giorniMancanti > 1 ? 'giorni' : 'giorno') .
                                                                            ' e'
                                                                        : '';

                                                                // Formatta la stringa per le ore
                                                                $stringaOre =
                                                                    $oreMancanti > 0 ? $oreMancanti . ' ore' : '';
                                                            @endphp
                                                            @if ($expire_date < strtotime($oraCorrente))
                                                                <h4>Stato: Scaduto</h4>
                                                            @else
                                                                <h4>Tempo rimanente: {{ $stringaGiorni }}
                                                                    {{ $stringaOre }}</h4>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <br><br>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <form id="payment-form" class="mt-4 d-none">
                @csrf
                <!-- Aggiungi un campo nascosto per l'ID dell'insegnante -->
                <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
                <div class="row gap-4 ps-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-md-2">
                            <div class="card-sponsor d-flex align-items-center justify-content-center"
                                id="product_{{ $product->id }}" onclick="selectSponsor({{ $product->id }})">

                                {{-- DA AGGIUNGERE IMMAGINE DEL PACCHETTO CORRISPONDENTE --}}
                                @php
                                    $productDuration = $product->duration;
                                    [$hours, $minutes, $seconds] = explode(':', $productDuration);
                                @endphp
                                <h2 class="">{{ $hours }}h</h2>

                                <h2>{{ $product->price }}<span class="fs-4 ms-2">&euro;</span></h2>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Altri campi del modulo per il pagamento, ad esempio il token del pagamento -->
            </form>

            <div id="dropin-container"></div>

            <div class="col-1 ">

                <button type="button" id="submit-button" class=" btn btn-success d-none w-100"
                    onclick="CreateDrop_IN()">Paga</button>
            </div>
        </div>
        <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            let button_payment_form = document.getElementById('payment_form_active');
            let var_switch_payment_form = 0;
            button_payment_form.addEventListener('click', function() {
                var_switch_payment_form = !var_switch_payment_form;
                ActiveFormPayment();
            });
            var button = document.querySelector('#submit-button');
            var selectedProduct = null;


            function ActiveFormPayment() {
                if (var_switch_payment_form) {
                    document.getElementById('payment-form').classList.remove('d-none');
                    button_payment_form.classList.remove('btn-success');
                    button_payment_form.classList.add('btn-danger');
                    button_payment_form.textContent = 'Chiudi';
                    document.getElementById('accordionPanelsStayOpenExample').classList.add('d-none');
                    document.getElementById('accordionExample').classList.add('d-none');
                } else {
                    document.getElementById('payment-form').classList.add('d-none');
                    document.getElementById('accordionPanelsStayOpenExample').classList.remove('d-none');
                    document.getElementById('accordionExample').classList.remove('d-none');
                    button_payment_form.textContent = 'Qui';
                    button_payment_form.classList.remove('btn-danger');
                    button_payment_form.classList.add('btn-success');
                }
            }
            // Funzione per catturare l'ID del prodotto al click sulla card
            function selectSponsor(prodotto) {
                button.classList.remove('d-none');
                // Disabilita le altre cards
                var cards = document.querySelectorAll('.card-sponsor');
                cards.forEach(function(card) {
                    if (card.id !== 'product_' + prodotto) {
                        card.style.pointerEvents = 'none';
                    }
                });

                selectedProduct = prodotto;
            }

            function CreateDrop_IN() {
                // Verifica se è stato selezionato un prodotto prima di avviare Braintree
                if (selectedProduct) {
                    braintree.dropin.create({
                        authorization: 'sandbox_5rtv24b2_m6cftqk6gyd7gnfq',
                        selector: '#dropin-container',
                        locale: 'it_IT'
                    }, function(err, instance) {
                        button.addEventListener('click', function() {
                            instance.requestPaymentMethod(function(err, payload) {
                                // Ottieni il nonce del pagamento e invia il pagamento al server
                                var paymentMethodNonce = payload.nonce;
                                makePayment(paymentMethodNonce);
                            });
                        });
                    });
                } else {
                    alert("Seleziona un prodotto prima di procedere con il pagamento.");
                }
            }

            function makePayment(paymentMethodNonce) {
                var teacherId = document.getElementById('teacher_id').value;
                console.log(teacherId);

                // Invia i dati al server per elaborare il pagamento
                axios.post('{{ route('make.payment') }}', {
                        token: paymentMethodNonce,
                        product: selectedProduct, // Utilizza l'ID dell'insegnante
                        _token: '{{ csrf_token() }}'
                    })
                    .then(function(response) {
                        var data = response.data;
                        if (data.success) {
                            axios.post(
                                    'http://localhost:8000/api/v1/sponsorship-associate', {
                                        sponsorship_id: selectedProduct, // Utilizza l'ID del prodotto selezionato
                                        teacher_id: teacherId // Utilizza l'ID dell'insegnante
                                    })
                                .then(function(response) {
                                    console.log(response.data);
                                    // alert("Sponsorizzazione associata con successo agli insegnanti.");
                                    window.location.href = '{{ route('sponsor.thanks') }}';
                                })
                                .catch(function(error) {
                                    console.error('Errore durante la richiesta Axios:', error);
                                });
                        } else {
                            alert("Errore durante l'associare la sponsorizzazione agli insegnanti.");
                            alert(data.message); // Mostra un messaggio di errore
                        }
                    })
                    .catch(function(error) {
                        console.error('Errore durante la richiesta:', error);
                    });
            }
        </script>
    @endsection
    <style>
        #dropin-container {
            width: 75%;
            margin: 0 auto;
        }

        .accordion-button {
            box-shadow: none !important;
        }

        .w_95 {
            width: 95%;

        }

        .card-sponsor {
            position: relative;
            width: 190px;
            height: 254px;
            background-color: #000;
            display: flex;
            flex-direction: column;
            justify-content: end;
            padding: 12px;
            gap: 12px;
            border-radius: 8px;
            cursor: pointer;
            color: white;
        }

        .card-sponsor::before {
            content: '';
            position: absolute;
            inset: 0;
            left: -5px;
            margin: auto;
            width: 200px;
            height: 264px;
            border-radius: 10px;
            background: linear-gradient(-45deg, #e81cff 0%, #40c9ff 100%);

            z-index: -1;
            pointer-events: none;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-sponsor::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(-45deg, #fc00ff 0%, #00dbde 100%);
            transform: translate3d(0, 0, 0) scale(0.95);
            filter: blur(90px);
        }

        .heading {
            font-size: 20px;
            text-transform: capitalize;
            font-weight: 700;
        }

        .card-sponsor p:not(.heading) {
            font-size: 14px;
        }

        .card-sponsor p:last-child {
            color: #e81cff;
            font-weight: 600;
        }

        .card-sponsor:hover::after {
            filter: blur(30px);
            z-index: -1;
        }

        .card-sponsor:hover::before {
            transform: rotate(-90deg) scaleX(1.34) scaleY(0.77);
        }

        /* ACCORDION */
    </style>
