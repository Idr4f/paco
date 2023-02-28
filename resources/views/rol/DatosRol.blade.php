@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Datos del rol <strong>{{ $num >= 1 ? $rol->nom_rol : "" }}</strong></h1>
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
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalNombre">
                <span class="font-weight-bold">Nombre:</span> {{ $rol->nom_rol }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalDescripcion">
                <span class="font-weight-bold">Descripción:</span> {{ $rol->desc_rol }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalEstado">    
                @if($rol->estado == 'A')
                    <span class="font-weight-bold">Estado:</span> Activo <i class="fas fa-chevron-right float-right"></i>
                @elseif($rol->estado == 'E')
                    <span class="font-weight-bold">Estado:</span> Eliminado <i class="fas fa-chevron-right float-right"></i>
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
                    {!! Form::model($rol, ['route' => ['modificar-nombre-rol', $rol->id], 'method' => 'PUT']) !!}
                    @if($rol->nom_rol == 'Admin')
                        <div class="form-group">                            
                            {!! Form::text('nom_rol', $rol->nom_rol, ['class' => 'form-control', 'placeholder' => 'Nombre del rol', 'disabled' => 'disabled']) !!}
                        </div>
                        @else
                        <div class="form-group">                            
                            {!! Form::text('nom_rol', $rol->nom_rol, ['class' => 'form-control', 'placeholder' => 'Nombre del rol']) !!}
                        </div>
                        @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                            {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
        <!-- /Modal Edición nombre -->

        <!-- Modal Edición correo -->
        <div class="modal fade" id="ModalDescripcion" tabindex="-1" role="dialog" aria-labelledby="descripcionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correoModalLabel">Modificar descripción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($rol, ['route' => ['modificar-descripcion-rol', $rol->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('desc_rol', $rol->desc_rol, ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}                        
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
                    {!! Form::model($rol, ['route' => ['modificar-estado-rol', $rol->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::select('estado', ['A' => 'Activo', 'E' => 'Eliminado'], $rol->estado, ['class'=>'form-control']) !!}
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
    
    </div>
    @else
    <br /><h3>No hay datos con el nombre {{ $nom_rol }}.</h3>
    @endif

    </div>

</div>

@endsection
