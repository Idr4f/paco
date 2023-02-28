@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Crear opción</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('errorMessagesPartial')
        {!! Form::open(['route' => 'agregar-opcion-guardar', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('nom_opcion', 'Nombre de la opción') !!}
            {!! Form::text('nom_opcion', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la opción']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('desc_opcion', 'Descripción de la opción') !!}
            {!! Form::text('desc_opcion', null, ['class' => 'form-control', 'placeholder' => 'Descripción de la opción']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('app_establec', 'APP establecimiento') !!}
            {!! Form::select('app_establec', ['S' => 'Sí', 'N' => 'No'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('app_miembro', 'APP Vecino') !!}
            {!! Form::select('app_miembro', ['S' => 'Sí', 'N' => 'No'], null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('estado', 'Estado') !!}
            {!! Form::select('estado', ['A' => 'Activo', 'E' => 'Eliminado'], null, ['class'=>'form-control']) !!}
        </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
