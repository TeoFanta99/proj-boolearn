@extends('dashboard')

@section('sezione')

<h1>messaggi</h1>

<div class="messages-container">
  <div class="row ms-4">
    @foreach ($messages as $message)
    <div class="col col-md-6 col-lg-4 col-12" style="border: 1px solid black">
      <h5>{{$message->email_title}}</h5>
      <div class="message-content">
        <p>{{$message->description}}</p>
      </div>
      <span>{{$message->user_name}}</span>
      <br>
      <span>{{$message->user_email}}</span>
    </div>
    @endforeach
  </div>
</div>
@endsection