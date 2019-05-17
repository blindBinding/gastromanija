@extends('layouts.app')


@section('content')
<div class="container">
        <h1>Kreiraj Recept</h1>
        {{-- {{!! Form::open(['action' => 'RecipesController@store', 'method' => 'POST')] !!}}
            <div class="form-group">
            {{Form::label('title', 'Recept')}}
            {{Form::nziv('title', '', [class="form-control", 'placeholder' => 'Naziv'])}}
            </div>
        {{!! Form::close() !!}}  --}}

        {{ Form::open(['action' => 'RecipesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

        <div class="form-group">
            {{Form::label('naziv', 'Naziv:')}}
            {{Form::text('naziv', '', ['class' => 'form-control', 'placeholder' => 'Naziv...'])}}
            </div>

            <div class="form-group">
                {{Form::label('kratak_opis', 'Kratak opis:')}}
                {{Form::text('kratak_opis', '', ['class' => 'form-control', 'placeholder' => 'Rečenica, dve...'])}}
                </div>

                <div class="form-group">
                    {{Form::label('opis', 'Opis:')}}
                    {{Form::textarea('opis', '', ['class' => 'ckeditor', 'placeholder' => 'Opis...'])}}
                    </div>

                    {{-- <div class="form-group">
                        {{Form::label('vreme_spremanja', 'Vreme spremanja')}}
                        {{Form::text('vreme_spremanja', '',['class' => 'form-control', 'placeholder' => 'Minuta'])}}
                        </div> --}}

                        <div class="form-group">
                                {{Form::label('kuhinje_id', 'Kuhinja:')}}
                                {{Form::radio('kuhinje_id', 'Italijanska')}} Italijanska
                                {{Form::radio('kuhinje_id', 'Srpska')}} Srpska
                            </div>

                            <div class="form-group">
                                    {{Form::label('sastojci_id', 'Obrok:')}}
                                    {{Form::checkbox('sastojci_id[]', 'Meso')}} Meso
                                    {{Form::checkbox('sastojci_id[]', 'Jaja')}} Jaja
                                    {{Form::checkbox('sastojci_id[]', 'Salata')}} Salata
                                </div>

                        <div class="form-group">
                            {{Form::label('author', 'Autor:')}}
                            {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Ime...'])}}
                            </div>
                            <div class="form-group">
                                {{Form::file('cover_image')}}

                            </div>
                            {{Form::submit('Kreiraj', ['class'=>'btn btn-primary'])}}
        {{ Form::close() }}
    </div>
 @endsection
