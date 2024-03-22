@extends('layouts.app')
@section('content')
    <div id="dropin-container"></div>
    <form id="payment-form">
        @csrf
        <!-- Aggiungi un campo nascosto per l'ID dell'insegnante -->
        <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
        <select name="product" id="product">
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <!-- Altri campi del modulo per il pagamento, ad esempio il token del pagamento -->
        <button type="button" id="submit-button" onclick="CreateDrop_IN()">Paga</button>
    </form>
    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var button = document.querySelector('#submit-button');

        function CreateDrop_IN() {
            braintree.dropin.create({
                authorization: 'sandbox_5rtv24b2_m6cftqk6gyd7gnfq',
                selector: '#dropin-container'
            }, function(err, instance) {
                button.addEventListener('click', function() {
                    instance.requestPaymentMethod(function(err, payload) {
                        
                        // Ottieni il nonce del pagamento e invia il pagamento al server
                        var paymentMethodNonce = payload.nonce;
                        makePayment(paymentMethodNonce);

                    });
                })
            });
        }

        function makePayment(paymentMethodNonce) {
            var teacherId = document.getElementById('teacher_id').value;
            var productId = document.getElementById('product').value;

            // Invia i dati al server per elaborare il pagamento
            axios.post('{{ route('make.payment') }}', {
                    token: paymentMethodNonce,
                    product: productId,
                    _token: '{{ csrf_token() }}'
                })
                .then(function(response) {
                    var data = response.data;
                    if (data.success) {
                        axios.post(
                                'http://localhost:8000/api/v1/sponsorship-associate', {
                                    sponsorship_id: productId,
                                    teacher_id: teacherId
                                })
                            .then(function(response) {
                                console.log(response.data);
                                alert("Sponsorizzazione associata con successo agli insegnanti.");
                            })
                            .catch(function(error) {
                                console.error('Errore durante la richiesta Axios:', error);
                                alert("Errore durante l'associare la sponsorizzazione agli insegnanti.");
                            });
                    } else {
                        alert(data.message); // Mostra un messaggio di errore
                    }
                })
                .catch(function(error) {
                    console.error('Errore durante la richiesta:', error);
                });
        }
    </script>
@endsection
