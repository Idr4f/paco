@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Crear rol</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('errorMessagesPartial')
        {!! Form::open(['route' => 'agregar-rol-guardar', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('nom_rol', 'Nombre del rol') !!}
            {!! Form::text('nom_rol', null, ['class' => 'form-control', 'placeholder' => 'Nombre del rol']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('desc_rol', 'Descripción del rol') !!}
            {!! Form::text('desc_rol', null, ['class' => 'form-control', 'placeholder' => 'Descripción del rol']) !!}
        </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
