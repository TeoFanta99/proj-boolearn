@extends('dashboard')
@section('sezione')
    <div class="background_show " id="main">
        <img src="{{ asset('sl_021821_40890_06.jpg') }}" class="w-100 h-100 position-absolute z-index-1" alt=""
            id="sfondo">
        <h1 class="dashboard-title">MESSAGGI</h1>
        <br>
        @if (session('error'))
            <div> {{ session('error') }}</div>
        @endif
        @if (!$teacher->sponsorships->isEmpty())
        <div class="main-content ps-4 overflow-hidden w_95">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Attive
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul class="list-unstyled row">
                            @foreach ($teacher->sponsorships as $sponsorship)
                                <li>
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-content">
                                                <h2 class="card-title">{{ $sponsorship->name }}</h2>
                                                <p><strong>Pacchetto acquistato: </strong>{{ $sponsorship->name }}</p>
                                                <p><strong>Data di acquisto: </strong>{{ $sponsorship->pivot->start_date }}</p>
                                                <p><strong>Scadenza del pacchetto: </strong>{{ $sponsorship->pivot->expire_date }}</p>
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
            <form id="payment-form">
                @csrf
                <!-- Aggiungi un campo nascosto per l'ID dell'insegnante -->
                <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
                {{-- <div class="row gap-4 ps-4">
                    @foreach ($products as $product)
                        <div class="col-12 col-md-3">
                            <div class="card-sponsor position-relative" id="product_{{ $product->id }}"
                                onclick="selectSponsor({{ $product->id }})">
                                <div class="container_absolute_image position-absolute w-50">
                                    {{-- DA AGGIUNGERE IMMAGINE DEL PACCHETTO CORRISPONDENTE --}}
                                    {{-- <img src="{{asset('/24h.png')}}" alt="" class="w-100"> --}}
                                {{-- </div>
                                <h2>{{ $product->name }}</h2>
                                <h2>{{ $product->price }}</h2>
                            </div>
                        </div>
                    @endforeach --}}
                {{-- </div> --}} 

                <!-- Altri campi del modulo per il pagamento, ad esempio il token del pagamento -->
            </form>
            <div id="dropin-container"></div>
        </div>
        <button type="button" id="submit-button" class=" btn btn-success d-none" onclick="CreateDrop_IN()">Paga</button>
        <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            var button = document.querySelector('#submit-button');
            var selectedProduct = null;

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
    </style>
