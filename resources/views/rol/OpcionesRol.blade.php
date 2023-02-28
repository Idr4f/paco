<?php

use \App\Http\Controllers\RolesController;

?>

@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Opciones del rol <strong>{{ $num >= 1 ? $rol->nom_rol : "" }}.</strong></h1>
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
                <span class="font-weight-bold">Nombre:</span> {{ $rol->nom_rol }}

            <a class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Descripción:</span> {{ $rol->desc_rol }}
            </a>
            <a class="list-group-item list-group-item-action">    
                @if($rol->estado == 'A')
                    <span class="font-weight-bold">Estado:</span> Activo 
                @elseif($rol->estado == 'E')
                    <span class="font-weight-bold">Estado:</span> Eliminado
                @endif
            </a>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Fecha de creación:</span> {{ \Carbon\Carbon::parse($rol->creado_e)->format('d/m/Y H:i:s')}}
            </span>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Última actualización del rol:</span> {{ \Carbon\Carbon::parse($rol->actualizado_e)->format('d/m/Y H:i:s')}}
            </span>
        </div>

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
                        <th>Nombre</th>
                        <th>Creación</th>      
                        <th>Lectura</th>  
                        <th>Modificación</th>  
                        <th>Eliminación</th>  
                        <th>Estado</th>
                        <th style="width: 10%">Acción</th>
                        <th style="width: 10%">Eliminar</th>
                    </tr>
                </thead>
                    <tbody>
                    @foreach ($opciones as $opcion)
                        <tr>
                            <td>{{ ++$i }}</td>                        
                            <td>{{ RolesController::ConsultarNomOpcion($opcion->id_opcion) }}</td>                                 
                            <td>{{ $opcion->creacion }}</td>  
                            <td>{{ $opcion->lectura }}</td>  
                            <td>{{ $opcion->modificacion }}</td>  
                            <td>{{ $opcion->eliminacion }}</td>  
                            @if($opcion->estado == 'A')
                                <td>Activo</td>
                            @elseif($opcion->estado == 'E')
                                <td>Eliminado</td>
                            @endif
                            
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
                                        <h5 class="modal-title" id="editarModalLabel{{ $i }}">Modificar configuraciones opción: <strong>{{ RolesController::ConsultarNomOpcion($opcion->id_opcion) }}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">                                        
                                            {!! Form::model($rol, ['route' => ['modificar-rol-opcion', $opcion->id, $rol->nom_rol], 'method' => 'PUT']) !!}
                                            <div class="form-group">
                                                {!! Form::label('creacion', 'Creación') !!}
                                                {!! Form::select('creacion', ['S' => 'Sí', 'N' => 'No'], $opcion->creacion, ['class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('lectura', 'Lectura') !!}
                                                {!! Form::select('lectura', ['S' => 'Sí', 'N' => 'No'], $opcion->lectura, ['class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('modificacion', 'Modificación') !!}
                                                {!! Form::select('modificacion', ['S' => 'Sí', 'N' => 'No'], $opcion->modificacion, ['class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('eliminacion', 'Eliminación') !!}
                                                {!! Form::select('eliminacion', ['S' => 'Sí', 'N' => 'No'], $opcion->eliminacion, ['class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('estado', 'Estado') !!}
                                                {!! Form::select('estado', ['A' => 'Activo', 'E' => 'Eliminado'], $opcion->estado, ['class'=>'form-control']) !!}
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
                                        <h5 class="modal-title" id="eliminarModalLabel{{ $i }}">Eliminar opción del rol: <strong>{{ RolesController::ConsultarNomOpcion($opcion->id_opcion) }}</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                        <div class="modal-body">                                        
                                            {!! Form::model($rol, ['route' => ['eliminar-rol-opcion', $opcion->id, $rol->nom_rol], 'method' => 'DELETE']) !!}
                                            {!! Form::label('estado', '¿Está seguro de que quiere eliminar la opción del rol seleccionado?') !!}
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
                    {{ $opciones->links() }}
                    </div>                
                </div>
                <!-- /Paginación de tabla -->
                
            </div>

        <!-- Final tabla de consulta de opciones -->

        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalAgregarOpc">Asociar nueva opción</a>
    
        <!-- Modal Agregar opción -->
        <div class="modal fade" id="ModalAgregarOpc" tabindex="-1" role="dialog" aria-labelledby="agregaropcModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregaropcModalLabel">Agregar opción al rol: <strong>{{ $rol->nom_rol }}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                                        
                    {!! Form::model($rol, ['route' => ['agregar-rol-opcion', $rol->id, $rol->nom_rol], 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{ Form::select('id_opcion', $select, null, ['class'=>'form-control']) }}
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
        <!-- /Modal Agregar opción -->
    
    </div>
    @else
    <br /><h3>No hay datos con el nombre {{ $nom_rol }}.</h3>
    @endif

    </div>

</div>

@endsection
