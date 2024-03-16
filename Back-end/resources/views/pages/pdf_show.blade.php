@extends('layouts.app')
@section('content')

<div class="cv_container">
    <embed src="{{asset('storage/' . $teacher->cv_url)}}"  type="application/pdf" width="100%" height="100%">
</div>
@endsection