@extends('layouts.app')
@section('head')
<title>Reviews</title>
@endsection
@section('content')

<h1>Recensioni</h1>

<div class="reviews-container">
  <div class="row">
    @foreach ($reviews as $review)
    <div class="col col-12 col-md-6 col-lg-3 mf_col" style="border: 1px solid black">
      <h5>{{$review->title}}</h5>
      <div class="review-content">
        <p>{{$review->description}}</p>
      </div>
      <span>{{$review->email}}</span>
    </div>
    @endforeach
  </div>
</div>


@endsection