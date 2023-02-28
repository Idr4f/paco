@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Crear usuario</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('errorMessagesPartial')
        {!! Form::open(['route' => 'agregar-usuario-guardar', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('email', 'Correo electrónico') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo electrónico']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nombre', 'Nombres') !!}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombres']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Contraseña') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
        </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
