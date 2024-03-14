@extends('layouts.app')
@section('content')

<div class="button_container">
    <button class="ms_button">
        <a href="{{ route('user.create') }}">CREA</a>
    </button>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <ul>
                @foreach ($users as $user)
                <li>
                    <a href="{{route('user.show' , $user->id)}}">{{$user->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection