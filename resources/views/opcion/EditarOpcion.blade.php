@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar opción: {{ $opc->nom_opcion }}</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('errorMessagesPartial')
        {!! Form::model($opc, ['route' => ['editar-opcion-guardar', $opc->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            {!! Form::label('nom_opcion', 'Nombre de la opción') !!}
            {!! Form::text('nom_opcion', $opc->nom_rol, ['class' => 'form-control', 'placeholder' => 'Nombre de la opción']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('desc_opcion', 'Descripción de la opción') !!}
            {!! Form::text('desc_opcion', $opc->desc_opcion, ['class' => 'form-control', 'placeholder' => 'Descripción de la opción']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('app_establec', 'APP establecimiento') !!}
            {!! Form::select('app_establec', ['S' => 'Sí', 'N' => 'No'], $opc->app_establec, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('app_miembro', 'APP Vecino') !!}
            {!! Form::select('app_miembro', ['S' => 'Sí', 'N' => 'No'], $opc->app_miembro, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('estado', 'Estado') !!}
            {!! Form::select('estado', ['A' => 'Activo', 'E' => 'Eliminado'], $opc->estado, ['class'=>'form-control']) !!}
        </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
