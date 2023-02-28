@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar establecimiento: {{ $establ->nom_establec }}</h1>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <div class="col-md-6 mb-4 mx-auto d-block">
                <img src="{{ $establ->ruta_imagen_establ }}" width="250" height="auto" class="img-fluid" alt="">
            </div>

        @include('errorMessagesPartial')
        {!! Form::model($establ, ['route' => ['editar-establecimiento-guardar', $establ->id], 'method' => 'PUT', 'files' => 'true']) !!}
        <div class="form-group">
            {!! Form::label('ruta_imagen_establ', 'Imagen') !!}
            {!! Form::file('ruta_imagen_establ',['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('cod_establec', 'Código del establecimiento') !!}
            {!! Form::text('cod_establec', $establ->cod_establec, ['class' => 'form-control', 'placeholder' => 'Código del establecimiento']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nom_establec', 'Nombre del establecimiento') !!}
            {!! Form::text('nom_establec', $establ->nom_establec, ['class' => 'form-control', 'placeholder' => 'Nombre del establecimiento']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nom_corto_establec', 'Nombre corto del establecimiento') !!}
            {!! Form::text('nom_corto_establec', $establ->nom_corto_establec, ['class' => 'form-control', 'placeholder' => 'Nombre corto del establecimiento']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nom_administrador', 'Nombre del administrador') !!}
            {!! Form::text('nom_administrador', $establ->nom_administrador, ['class' => 'form-control', 'placeholder' => 'Nombre del administrador']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('telefono', 'Teléfono') !!}
            {!! Form::text('telefono', $establ->telefono, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('celular', 'Celular') !!}
            {!! Form::text('celular', $establ->celular, ['class' => 'form-control', 'placeholder' => 'Celular']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('direccion', 'Dirección') !!}
            {!! Form::text('direccion', $establ->direccion, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('correo', 'Correo eléctronico') !!}
            {!! Form::text('correo', $establ->correo, ['class' => 'form-control', 'placeholder' => 'Correo eléctronico']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tipo_establec', 'Tipo de establecimiento') !!}
            {{ Form::select('tipo_establec', $tipo_establec, $establ->tipo_establec, ['class'=>'form-control']) }}
        </div>
        <div class="form-group">
            {!! Form::label('estado', 'Estado') !!}
            {!! Form::select('estado', ['A' => 'Activo', 'B' => 'Bloqueado','E' => 'Eliminado'], $establ->estado, ['class'=>'form-control']) !!}
        </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
