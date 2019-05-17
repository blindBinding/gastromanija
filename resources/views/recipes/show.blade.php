@extends('layouts.app')

@section('content')



<div class="container">

<div class="card text-white bg-secondary mb-3">

    
    

    
           
        <h3 class="card-header bg-dark text-center"><a href="/recipes/{{$recipe->id}}" class="text-success ">{{$recipe->naziv}}</a></h3>

        <img style="width:100%" src="/storage/cover_images/{{$recipe->cover_image}}">

        <br>

        {{-- <div>Kratak opis: {{$recipe->kratak_opis}}</div> --}}
        <div class="card-body ">Opis: {!!$recipe->opis!!}</div>
        <div class="card-body ">Kuhinja: {!!$recipe->kuhinje_id!!}</div>
        {{-- <div>Vreme spremanja: {{$recipe->vreme_spremanja}}</div> --}}
        <div class="card-footer">Autor: {{$recipe->author}}</div>
        
        {{-- <div class="card-footer">Kuhinja: {{$recipe->kuhinja}}</div>
        <div class="card-footer">Obrok: {{$recipe->obrok}}</div> --}}
        
    <small class="card-footer">Kreirano: {{$recipe->created_at}}  {{$recipe->user->name}}</small>
    <a href="/recipes" class="btn btn-primary">Nazad</a>
    @if(!Auth::guest())
    @if(Auth::user()->id == $recipe->user_id)

    <a href="/recipes/{{$recipe->id}}/edit" class="btn btn-warning">Promeni</a>
   

    {!!Form::open(['action' => ['RecipesController@destroy', $recipe->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Obriši', ['class' => 'btn btn-danger btn-block'])}}
    {!!Form::close()!!}
    @endif
    @endif
</div>
</div>
@endsection
