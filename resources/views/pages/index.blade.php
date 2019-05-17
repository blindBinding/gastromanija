@extends('layouts.app')


@section('content')
<div class="jumbotron text-center">
        <h1>Dobrodošli na Gastromaniju!</h1>
        <p>Sve recepte možete pronaći ovde!!!</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
{{-- <h1>{{$title}}</h1>

@if (count($recepti) > 0)
<ul class="list-group">
    @foreach ($recepti as $recept)
<li class="list-group-item">{{$recept}}</li>
        
    @endforeach
</ul>
@endif --}}

 @endsection
    