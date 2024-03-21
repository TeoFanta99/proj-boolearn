@extends('layouts.app')
@section('content')
<p>Teacher ID: {{ $teacher->id }}</p>
<form id="payment-form">
    @csrf
    <select name="product" id="product">
        @foreach ($products as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
    </select>
    <!-- Aggiungi un campo nascosto per inviare l'ID dell'insegnante -->
    <input type="hidden" name="teacher_id" id="teacher_id" value="{{ $teacher->id }}">
    <!-- Aggiungi un campo nascosto per inviare il token -->
    <input type="hidden" name="token" id="token" value="fake-valid-nonce">
    <!-- Altri campi del modulo per il pagamento, ad esempio il token del pagamento -->
    <!-- Aggiungi il codice necessario per ottenere e inviare il token di pagamento -->
    <button type="button" onclick="makePayment()">Paga</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function makePayment() {
        var teacherId = document.getElementById('teacher_id').value;
        var productId = document.getElementById('product').value;
        var token = document.getElementById('token').value;

        var formData = new FormData();
        formData.append('product', productId);
        formData.append('teacher_id', teacherId);
        formData.append('token', token);

        fetch('{{ route('make.payment') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Gestisci la risposta dal server
            console.log(data);
            if(data.success) {
                console.log(data.success);
                axios.post('http://localhost:8000/api/v1/sponsorship-associate', {
                    sponsorship_id: productId,
                    teacher_id: teacherId
                })
                .then(response => {
                    console.log(response.data);
                    alert("Sponsorizzazione associata con successo agli insegnanti.");
                })
                .catch(error => {
                    console.error('Errore durante la richiesta Axios:', error);
                    alert("Errore durante l'associare la sponsorizzazione agli insegnanti.");
                });
            } else {
                alert(data.message); // Mostra un messaggio di errore
            }
        })
        .catch(error => {
            console.error('Errore durante la richiesta:', error);
        });
    }
</script>
@endsection
