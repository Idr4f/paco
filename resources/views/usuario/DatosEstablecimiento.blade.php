<?php

use \App\Http\Controllers\EstablecimientosController;
use \App\Http\Controllers\RolesController;
?>

@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar establecimientos asociados al usuario <strong>{{ $num >= 1 ? $usuario->nombre : "" }}</strong></h1>
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
    
        <div class="list-group">
            <a class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Nombre:</span> {{ $usuario->nombre }}
            </a>
            <a class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Correo:</span> {{ $usuario->email }}
            </a>
            <a class="list-group-item list-group-item-action">    
                @if($usuario->estado == 'A')
                    <span class="font-weight-bold">Estado:</span> Activo
                @elseif($usuario->estado == 'B')
                    <span class="font-weight-bold">Estado:</span> Bloqueado
                @elseif($usuario->estado == 'R')
                    <span class="font-weight-bold">Estado:</span> Retirado
                @endif
                
            </a>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Fecha de creación:</span> {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i:s')}}
            </span>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Última actualización del usuario:</span> {{ \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i:s')}}
            </span>
        </div>
        
        <!-- V2 -->
         <!-- Mostrar los mensajes de error -->
         <div class="container mt-2">
            @include('errorMessagesPartial')
        </div>

        <!-- Tabla de consulta de opciones -->
        <div class="table-responsive mt-4">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Establecimiento</th>
                        <th>Rol</th>   
                        <th>Número de inmueble</th>   
                        <th>Fecha asignación</th>
                        <th>Fecha de actualización</th>
                        <th style="width: 10%">Acción</th>
                        <th style="width: 10%">Eliminar</th>
                    </tr>
                </thead>
                    <tbody>
                
                    @foreach ($UserRolEstablecimientos as $UserRolEstablec)
                        <tr>
                            <td>{{ ++$i }}</td>                        
                            <td>{{ EstablecimientosController::ConsultarNomEstablec($UserRolEstablec->id_establecimiento) }}</td>
                            <td>{{ RolesController::ConsultarNomRol($UserRolEstablec->id_rol) }}</td>
                            <td>{{ $UserRolEstablec->num_inmueble }}</td>    
                            <td>{{ \Carbon\Carbon::parse($UserRolEstablec->creado_e)->format('d/m/Y H:i:s')}}</td>                
                            <td>{{ \Carbon\Carbon::parse($UserRolEstablec->actualizado_e)->format('d/m/Y H:i:s')}}</td>
                            <td>                        
                                <a class="btn btn-primary mt-2 mt-md-0 mb-2 mb-md-0" data-toggle="modal" data-target="#ModalEditar{{ $i }}" href="#">Editar</a>                                
                            </td>  

                            <td>                        
                                <a class="btn btn-danger mt-2 mt-md-0 mb-2 mb-md-0" data-toggle="modal" data-target="#ModalEliminar{{ $i }}" href="#">Eliminar</a>                                
                            </td>  
                        </tr>
                        
                        <!-- Modal Edición -->
                        <div class="modal fade" id="ModalEditar{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel{{ $i }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarModalLabel{{ $i }}">Modificar asignación del establecimiento: <strong>{{ EstablecimientosController::ConsultarNomEstablec($UserRolEstablec->id_establecimiento) }}</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                                        
                                    {!! Form::model($UserRolEstablec, ['route' => ['modificar-rol-establec', $UserRolEstablec->id, $usuario->email], 'method' => 'PUT']) !!}
                                    <div class="form-group">
                                        {!! Form::label('id_rol', 'Rol') !!}
                                        {{ Form::select('id_rol', $select_roles, $UserRolEstablec->id_rol, ['class'=>'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('num_inmueble', 'Número de inmueble') !!}
                                        {!! Form::text('num_inmueble', $UserRolEstablec->num_inmueble, ['class' => 'form-control', 'placeholder' => 'Número de inmueble']) !!}
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
                        <!-- /Modal Edición -->

                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="ModalEliminar{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel{{ $i }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eliminarModalLabel{{ $i }}">Eliminar asignación del establecimiento: <strong>{{ EstablecimientosController::ConsultarNomEstablec($UserRolEstablec->id_establecimiento) }}</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                                        
                                    {!! Form::model($UserRolEstablec, ['route' => ['eliminar-rol-establec', $UserRolEstablec->id, $usuario->email], 'method' => 'DELETE']) !!}
                                    {!! Form::label('UserRolEstablec', '¿Está seguro de que quiere eliminar la asociación del establecimiento seleccionado?') !!}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    {!! Form::close() !!}
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal Eliminar -->
                            
                    @endforeach
                    </tbody>
                </table>

                <!-- Paginación de tabla -->
                <div class="container col-md-12">
                    <div class="row mb-2 justify-content-center">
                    {{ $UserRolEstablecimientos->links() }}
                    </div>                
                </div>
                <!-- /Paginación de tabla -->
                
            </div>

        <!-- Final tabla de consulta de opciones -->

        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregarRolEstablec">Asociar establecimiento</a>

        <!-- Modal Agregar Rol / Establecimiento -->
        <div class="modal fade" id="ModalAgregarRolEstablec" tabindex="-1" role="dialog" aria-labelledby="agregarRolEstablecModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarRolEstablecModalLabel">Asociar establecimiento al usuario: <strong>{{ $usuario->nombre }}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">                                        
                        {!! Form::model($usuario, ['route' => ['agregar-rol-establec', $usuario->id, $usuario->email], 'method' => 'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('id_rol', 'Rol') !!}
                            {{ Form::select('id_rol', $select_roles, null, ['class'=>'form-control']) }}
                        </div>
                        <div class="form-group">
                            {!! Form::label('id_establecimiento', 'Establecimiento') !!}
                            {{ Form::select('id_establecimiento', $select_establec, null, ['class'=>'form-control']) }}
                        </div>
                        <div class="form-group">
                            {!! Form::label('num_inmueble', 'Número de inmueble') !!}
                            {!! Form::text('num_inmueble', null, ['class' => 'form-control', 'placeholder' => 'Número de inmueble']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                                {!! Form::close() !!}
                    </div>
            </div>
        </div>
        <!-- /Modal Agregar Rol / Establecimiento -->
    

        <!-- /V2 -->
    
    </div>
    @else
    <br /><h3>No hay datos con el correo {{ $email }}.</h3>
    @endif

    </div>

</div>

@endsection
