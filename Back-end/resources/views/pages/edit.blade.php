@extends('layouts.app')
@section('content')
    <h1>Modifica Profilo</h1>
    {{-- @auth --}}
    <form action="{{route('user.update', Auth::user()->id)}}" method="POST" enctype="multipart/form-data" id="Form_update">

        @csrf
        @method('PUT')
       
        <div class="container w-75">
            <div class="row  gap-2">
                <div class="col-8 flex-column">
                    <div class="col-3">
                        <label for="tax_id">P.IVA:</label>
                        <input type="number" id="tax_id" name="tax_id" value="{{$teacher->tax_id}}">
                    </div>
                    <div class="col-3">
                        <div class="d-flex flex-column">
                            <label for="biography">Biografia</label>
                            <textarea name="biography" id="biography">{{$teacher->biography}}</textarea>
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="city">Citt&agrave;:</label>
                        <input type="text" id="city" name="city" value="{{$teacher->city}}">
                    </div>
                    <div class="col-3">
                        <label for="phone_number">Numero di telefono:</label>
                        <input type="number" id="phone_number" name="phone_number"value="{{$teacher->phone_number}}">
                    </div>
                    <div class="col-3">
                        <label for="image_url">Scegli immagine:</label>
                        <input type="file" id="image_url" name="image_url" accept="image/*">
                    </div>
                    <div class="col-3">
                        <label for="motto">Motto:</label>
                        <input type="text" id="motto" name="motto" value="{{$teacher->motto}}">
                    </div>
                    <div class="col-3">
                        <label for="cv_url">Carica il tuo CV </label>
                        <input type="file" id="cv_url" name="cv_url" accept=".pdf">
                    </div>
                </div>
                <div class="col-1">
                    <div class="img_container">
                        <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                    </div>
                </div>
                
                <a href="{{ route('teacher.index', Auth::user()->id) }}" target="_blank">CV</a>
                {{-- <iframe src="{{asset('storage/' . $teacher->cv_url)}}"  frameborder="0" scrolling="auto"></iframe> --}}
            </div>
                        
                    
                
            
            
            </div>
            <input type="submit" value="Conferma" class="mt-4">
        </form>
    </div>
   
@endsection
