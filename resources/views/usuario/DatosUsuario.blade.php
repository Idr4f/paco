@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Datos del usuario <strong>{{ $num >= 1 ? $usuario->nombre : "" }}</strong></h1>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">

    @if (session('message'))
    <div class="alert alert-success col-md-12" role="alert">
        <center>{{ session('message') }}</center>
    </div>
    @endif 

    @if($num >= 1)
    <div class="col-md-8">

        <!-- Mostrar los mensajes de error -->
        <div class="container mt-2">
            @include('errorMessagesPartial')
        </div>
    
        <div class="list-group">
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalNombre">
                <span class="font-weight-bold">Nombre:</span> {{ $usuario->nombre }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalCorreo">
                <span class="font-weight-bold">Correo:</span> {{ $usuario->email }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalEstado">    
                @if($usuario->estado == 'A')
                    <span class="font-weight-bold">Estado:</span> Activo <i class="fas fa-chevron-right float-right"></i>
                @elseif($usuario->estado == 'B')
                    <span class="font-weight-bold">Estado:</span> Bloqueado <i class="fas fa-chevron-right float-right"></i>
                @elseif($usuario->estado == 'R')
                    <span class="font-weight-bold">Estado:</span> Retirado <i class="fas fa-chevron-right float-right"></i>
                @endif
                
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalContrasena">
                <span class="font-weight-bold">Cambiar contraseña del usuario <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" href="./establecimiento-usuario?email={{ $usuario->email }}">
                <span class="font-weight-bold">Ver establecimientos asociados al usaurio <i class="fas fa-chevron-right float-right"></i>
            </a>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Fecha de creación:</span> {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i:s')}}
            </span>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Última actualización del usuario:</span> {{ \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i:s')}}
            </span>
        </div>        

        <!-- Modal Edición nombre -->
        <div class="modal fade" id="ModalNombre" tabindex="-1" role="dialog" aria-labelledby="nombreModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nombreModalLabel">Modificar nombre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($usuario, ['route' => ['modificar-nombre-usuario', $usuario->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('nombre', $usuario->nombre, ['class' => 'form-control', 'placeholder' => 'Nombres', 'required']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                            {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal Edición correo -->

        <!-- Modal Edición correo -->
        <div class="modal fade" id="ModalCorreo" tabindex="-1" role="dialog" aria-labelledby="correoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correoModalLabel">Modificar correo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($usuario, ['route' => ['modificar-correo-usuario', $usuario->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'Correo', 'required']) !!}                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                            {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal Edición correo -->

        <!-- Modal Edición estado -->
        <div class="modal fade" id="ModalEstado" tabindex="-1" role="dialog" aria-labelledby="estadoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="estadoModalLabel">Modificar estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($usuario, ['route' => ['modificar-estado-usuario', $usuario->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::select('estado', ['A' => 'Activo', 'B' => 'Bloqueado', 'R' => 'Retirado'], $usuario->estado, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                            {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal Edición estado -->

        <!-- Modal Edición contraseña -->
        <div class="modal fade" id="ModalContrasena" tabindex="-1" role="dialog" aria-labelledby="contrasenaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contrasenaModalLabel">Modificar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($usuario, ['route' => ['modificar-contrasena-usuario', $usuario->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::password('contrasena', ['class' => 'form-control', 'placeholder' => 'Ingresar nueva contraseña', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('contrasena_confirmar', ['class' => 'form-control', 'placeholder' => 'Confirmar nueva contraseña', 'required']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                            {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal Edición contraseña -->
    
    </div>
    @else
    <br /><h3>No hay datos con el correo {{ $email }}.</h3>
    @endif

    </div>

</div>

@endsection
