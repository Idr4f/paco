@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar usuario: {{ $usuario->nombre }}</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @include('errorMessagesPartial')
        {!! Form::model($usuario, ['route' => ['editar-usuario-guardar', $usuario->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            {!! Form::label('email', 'Correo electrónico') !!}
            {!! Form::email('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'Correo electrónico']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('nombre', 'Nombres') !!}
            {!! Form::text('nombre', $usuario->nombre, ['class' => 'form-control', 'placeholder' => 'Nombres']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('estado', 'Estado') !!}
            {!! Form::select('estado', ['A' => 'Activo', 'B' => 'Bloqueado', 'R' => 'Retirado'], $usuario->estado, ['class'=>'form-control']) !!}
        </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
