@extends('layouts.app')
@section('content')


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