@extends('layouts.app')
@section('head')
<title>Reviews</title>
@endsection
@section('content')

<h1>Recensioni</h1>
@foreach ($reviews as $review)
<span>{{$review -> description}}</span>
@endforeach
@endsection