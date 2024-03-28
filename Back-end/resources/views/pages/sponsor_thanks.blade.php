@extends('layouts.app')
@section('content')

<h2 style="color: green">Acquisto effettuato correttamente, grazie!</h2>

<button class="btn btn-primary me-3">
    <a href="{{ route('welcome') }}" style="text-decoration: none; color: white">
        TORNA ALLA HOME
    </a>
</button>

@endsection