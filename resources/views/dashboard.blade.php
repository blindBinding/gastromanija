@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        
                        <a href="/recipes/create" class="btn btn-primary">Kreiraj Recept</a>
                        
                        <hr>
                    <h3>Vaši Recepti</h3>
                    <hr>
                    @if(count($recipes) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Naziv</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($recipes as $recipe) 
                        <tr>
                            <td><a href="/recipes/{{$recipe->id}}">{{$recipe->naziv}}</a></td>
                            <td><a href="/recipes/{{$recipe->id}}/edit" class="btn btn-dark">Promeni</a></td>
                            <td>

                                    {!!Form::open(['action' => ['RecipesController@destroy', $recipe->id], 'method'=> 'POST', 'class'=>'pull-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Obriši', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                            </td>
                        </tr>
                            
                         @endforeach
                    </table>
                    
                     
                    @else() 
                        <p>Nemate kreirane recepte.</p>

                        @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
