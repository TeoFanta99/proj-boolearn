@extends('layouts.app')
@section('content')
<h1>Crea Profilo</h1>
{{-- @auth --}}
@if ($errors -> any())
<div class="alert alert-danger">
    <ul class="list-inline">
        @foreach ($errors -> all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="row flex-column gap-4">
        <div class="col-3">
            <label for="tax_id">P.IVA <span style="color: red;  font-size: 1.5em;">*</span> :</label>
            <input type="text" id="tax_id" name="tax_id">

        </div>

        <div class="col-3">
            <label for="cv_url">Carica il tuo CV <span style="color: red;  font-size: 1.5em;">*</span> :</label>
            <input type="file" id="cv_url" name="cv_url">

        </div>

        <div class="col-3">
            <div class="d-flex flex-column">
                <label for="biography">Biografia <span style="color: red;  font-size: 1.5em;">*</span></label>
                <textarea name="biography" id="biography"></textarea>
            </div>
        </div>
        <div class="col-3">
            <label for="city">Citt&agrave; <span style="color: red;  font-size: 1.5em;">*</span> :</label>
            <input type="text" id="city" name="city">
        </div>
        <div class="col-3">
            <label for="phone_number">Numero di telefono <span style="color: red;  font-size: 1.5em;">*</span> :</label>
            <input type="number" id="phone_number" name="phone_number">

        </div>
        <div class="col-3">
            <label for="image_url">Scegli immagine:</label>
            <input type="file" id="image_url" name="image_url">

        </div>
        <div class="col-3">
            <label for="motto">Motto:</label>
            <input type="text" id="motto" name="motto">
        </div>

        {{-- @foreach ($tags as $tag)
        <div>
            <input type="checkbox" name="tag_id[]" value="{{ $tag -> id }}" id="tag{{ $tag -> id }}">
            <label for="tag{{ $tag -> id }}">{{ $tag -> title }}</label>
            <br>
        </div>
        @endforeach --}}


        <div class="col-3"><input type="submit" value="CREA"></div>
        
        <br>

        <span style="color: red;  font-size: 2em;">* i seguenti campi sono obbligatori</span>


</form>
{{-- @endauth --}}
@endsection