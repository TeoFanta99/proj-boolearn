@extends('layouts.app')
@section('content')

<h2>ACQUISTO EFFETTUATO CORRETTAMENTE, GRAZIE!</h2>

<button class="btn btn-primary me-3 mt-2 w-100">
    <a href="{{ route('welcome') }}" style="text-decoration: none; color: white">
        TORNA ALLA HOME
    </a>
</button>
@endsection