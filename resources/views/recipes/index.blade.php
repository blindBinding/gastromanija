@extends('layouts.app')

@section('content')
<div class="container">

<h1 class="text-success bg-dark text-center text-success">Recepti</h1>
    @if (count($recipes) > 0)
    @foreach($recipes as $recipe)
        <div class="card text-white bg-secondary mb-3">

           <div class="row">
               <div class="col-md-12 col-sm-4">
                <img style="width:100%" src="/storage/cover_images/{{$recipe->cover_image}}">
               </div>
           </div>

           

           <div class="row">
                <div class="col-md-12 col-sm-12">
                        <h3 class="card card-header"><a href="/recipes/{{$recipe->id}}" class="text-success">{{$recipe->naziv}}</a></h3>
        
                        <p class="card-body">Kratak opis: {{$recipe->kratak_opis}}</p>
                        
                        <small class="card card-footer">Kreirano: {{$recipe->created_at}}  {{$recipe->user->name}}</small>
                </div>
            </div>

        
        
        
        </div>
        @endforeach
        {{$recipes->links()}}
    @else
    <p>Nema recepata</p>
        
    @endif
</div>

@endsection