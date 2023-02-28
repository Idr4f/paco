@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Datos de la opción <strong>{{ $num >= 1 ? $opc->nom_opcion : "" }}</strong></h1>
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
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalNom">
                <span class="font-weight-bold">Nombre de la opción:</span> {{ $opc->nom_opcion }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalDescOpc">
                <span class="font-weight-bold">Descripción de la opción:</span> {{ $opc->desc_opcion }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalAPPEstabl">
                @if($opc->app_establec == 'S')
                    <span class="font-weight-bold">APP Establecimiento:</span> Si <i class="fas fa-chevron-right float-right"></i>
                @elseif($opc->app_establec == 'N')
                    <span class="font-weight-bold">APP Establecimiento:</span> No <i class="fas fa-chevron-right float-right"></i>
                @endif
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalAppMiemb">
                @if($opc->app_miembro == 'S')
                    <span class="font-weight-bold">APP Vecino:</span> Si <i class="fas fa-chevron-right float-right"></i>
                @elseif($opc->app_miembro == 'N')
                    <span class="font-weight-bold">APP Vecino:</span> No <i class="fas fa-chevron-right float-right"></i>
                @endif
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalEstado">    
                @if($opc->estado == 'A')
                    <span class="font-weight-bold">Estado:</span> Activo <i class="fas fa-chevron-right float-right"></i>
                @elseif($opc->estado == 'E')
                    <span class="font-weight-bold">Estado:</span> Eliminado <i class="fas fa-chevron-right float-right"></i>
                @endif
            </a>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Fecha de creación:</span> {{ \Carbon\Carbon::parse($opc->creado_e)->format('d/m/Y H:i:s')}}
            </span>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Última actualización del rol:</span> {{ \Carbon\Carbon::parse($opc->actualizado_e)->format('d/m/Y H:i:s')}}
            </span>
        </div>
        
        <!-- Mostrar los mensajes de error -->
        <div class="container mt-2">
            @include('errorMessagesPartial')
        </div>
        

        <!-- Modal Edición Nombre -->
        <div class="modal fade" id="ModalNom" tabindex="-1" role="dialog" aria-labelledby="nombreModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nombreModalLabel">Modificar nombre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($opc, ['route' => ['modificar-nombre-opcion', $opc->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('nom_opcion', $opc->nom_opcion, ['class' => 'form-control', 'placeholder' => 'Nombre de la opción']) !!}
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
        <!-- /Modal Edición Nombre -->

        <!-- Modal Edición Descripción -->
        <div class="modal fade" id="ModalDescOpc" tabindex="-1" role="dialog" aria-labelledby="descopcModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descopcModalLabel">Modificar descripción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($opc, ['route' => ['modificar-descripcion-opcion', $opc->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('desc_opcion', $opc->desc_opcion, ['class' => 'form-control', 'placeholder' => 'Descripción de la opción']) !!}                        
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
        <!-- /Modal Edición Descripción -->

        <!-- Modal Edición APP Establecimiento -->
        <div class="modal fade" id="ModalAPPEstabl" tabindex="-1" role="dialog" aria-labelledby="appestablModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appestablModalLabel">Modificar estado APP establecimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($opc, ['route' => ['modificar-appestabl-opcion', $opc->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                    {!! Form::select('app_establec', ['S' => 'Sí', 'N' => 'No'], $opc->app_establec, ['class'=>'form-control']) !!}
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
        <!-- /Modal Edición APP Establecimiento -->

        <!-- Modal Edición APP miembro -->
        <div class="modal fade" id="ModalAppMiemb" tabindex="-1" role="dialog" aria-labelledby="appmiembModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appmiembModalLabel">Modificar estado APP vecino</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($opc, ['route' => ['modificar-appmiemb-opcion', $opc->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                    {!! Form::select('app_miembro', ['S' => 'Sí', 'N' => 'No'], $opc->app_miembro, ['class'=>'form-control']) !!}
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
        <!-- /Modal Edición APP miembro -->        

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
                    {!! Form::model($opc, ['route' => ['modificar-estado-opcion', $opc->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::select('estado', ['A' => 'Activo', 'E' => 'Eliminado'], $opc->estado, ['class'=>'form-control']) !!}
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
    <br /><h3>No hay datos con el nombre {{ $nom_opcion }}.</h3>
    @endif

    </div>

</div>

@endsection
