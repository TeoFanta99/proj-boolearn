@extends('layouts.app')
@section('content')
<h2>STORICO PAGAMENTI</h2>
<ul>
    @foreach ($teacher->sponsorships as $sponsorship )
    <li>
        {{-- "Pivot" serve per accedere alla tabella ponte --}}
        <span><b>Pacchetto acquistato: </b>{{$sponsorship -> name }}</span>
        <br>
        <span><b>Data di acquisto: </b> {{$sponsorship -> pivot -> start_date}}</span>
        <br>
        <span><b>Scadenza del pacchetto: </b>{{$sponsorship -> pivot -> expire_date}}</span>
    </li>
    <br><br>
    @endforeach
</ul>
<form id="payment-form">
    @csrf
    <!-- Aggiungi un campo nascosto per l'ID dell'insegnante -->
    <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
    <div class="row gap-4">
        @foreach ($products as $product)
        <div class="card-sponsor" id="product_{{ $product->id }}" onclick="selectSponsor({{ $product->id }})">
            <h2>{{ $product->name }}</h2>
            <h2>{{ $product->price }}</h2>
        </div>
        @endforeach
    </div>

    <!-- Altri campi del modulo per il pagamento, ad esempio il token del pagamento -->
</form>
<div id="dropin-container"></div>
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
                                alert("Sponsorizzazione associata con successo agli insegnanti.");
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