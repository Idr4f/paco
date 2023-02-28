@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Crear establecimiento</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            @include('errorMessagesPartial')
            {!! Form::open(['route' => 'agregar-establecimiento-guardar', 'method' => 'POST', 'files' => 'true']) !!}
            <div class="form-group">
                {!! Form::label('ruta_imagen_establ', 'Imagen') !!}
                {!! Form::file('ruta_imagen_establ',['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('cod_establec', 'Código del establecimiento') !!}
                {!! Form::text('cod_establec', null, ['class' => 'form-control', 'placeholder' => 'Código del establecimiento']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nom_establec', 'Nombre del establecimiento') !!}
                {!! Form::text('nom_establec', null, ['class' => 'form-control', 'placeholder' => 'Nombre del establecimiento']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nom_corto_establec', 'Nombre corto del establecimiento') !!}
                {!! Form::text('nom_corto_establec', null, ['class' => 'form-control', 'placeholder' => 'Nombre corto del establecimiento']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('nom_administrador', 'Nombre del administrador') !!}
                {!! Form::text('nom_administrador', null, ['class' => 'form-control', 'placeholder' => 'Nombre del administrador']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('telefono', 'Teléfono') !!}
                {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('celular', 'Celular') !!}
                {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Celular']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('direccion', 'Dirección') !!}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('correo', 'Correo eléctronico') !!}
                {!! Form::text('correo', null, ['class' => 'form-control', 'placeholder' => 'Correo eléctronico']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tipo_establec', 'Tipo de establecimiento') !!}
                {{ Form::select('tipo_establec', $tipo_establec, null, ['class'=>'form-control']) }}
            </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
