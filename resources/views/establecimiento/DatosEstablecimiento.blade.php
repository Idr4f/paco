@extends('layouts.app')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Datos del establecimiento <strong>{{ $num >= 1 ? $establ->nom_establec : "" }}</strong></h1>
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

        @if($url == true)
            <div class="col-md-6 mb-4 mx-auto d-block">
                <img src="{{ asset('establecimientos/'.$establ->ruta_imagen_establ) }}" width="250" height="auto" class="img-fluid" alt="">
            </div>
            
        @endif
        
        <div class="list-group">
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalCodEstabl">
                <span class="font-weight-bold">Código del establecimiento:</span> {{ $establ->cod_establec }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalNombre">
                <span class="font-weight-bold">Nombre:</span> {{ $establ->nom_establec }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalNombreCorto">
                <span class="font-weight-bold">Nombre corto del establecimiento:</span> {{ $establ->nom_corto_establec }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            @if($admin != null)
            <a class="list-group-item list-group-item-action" href="./datos-usuario?email={{ $admin->email }}">
                <span class="font-weight-bold">Administrador del establecimiento:</span> {{ $admin->nombre }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            @else
            <a class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Administrador del establecimiento:</span> No hay administrador asignado<i class="fas fa-chevron-right float-right"></i>
            </a>
            @endif
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalTelefono">
                <span class="font-weight-bold">Teléfono:</span> {{ $establ->telefono }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalCelular">
                <span class="font-weight-bold">Celular:</span> {{ $establ->celular }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalDireccion">
                <span class="font-weight-bold">Dirección:</span> {{ $establ->direccion }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalCorreo">
                <span class="font-weight-bold">Correo eléctronico:</span> {{ $establ->correo }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalTipoEstabl">
                <span class="font-weight-bold">Tipo de establecimiento:</span> {{ $establ->tipo_establec }} <i class="fas fa-chevron-right float-right"></i>
            </a>
            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#ModalEstado">    
                @if($establ->estado == 'A')
                    <span class="font-weight-bold">Estado:</span> Activo <i class="fas fa-chevron-right float-right"></i>
                @elseif($establ->estado == 'B')
                    <span class="font-weight-bold">Estado:</span> Bloqueado <i class="fas fa-chevron-right float-right"></i>
                @elseif($establ->estado == 'E')
                    <span class="font-weight-bold">Estado:</span> Eliminado <i class="fas fa-chevron-right float-right"></i>
                @endif
                
            </a>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Fecha de creación:</span> {{ \Carbon\Carbon::parse($establ->creado_e)->format('d/m/Y H:i:s')}}
            </span>
            <span class="list-group-item list-group-item-action">
                <span class="font-weight-bold">Última actualización del rol:</span> {{ \Carbon\Carbon::parse($establ->actualizado_e)->format('d/m/Y H:i:s')}}
            </span>
        </div>
        
        <!-- Mostrar los mensajes de error -->
        <div class="container mt-2">
            @include('errorMessagesPartial')
        </div>
        

        <!-- Modal Edición Código del establecimiendo -->
        <div class="modal fade" id="ModalCodEstabl" tabindex="-1" role="dialog" aria-labelledby="codigoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="codigoModalLabel">Modificar código del establecimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-codigo-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('cod_establec', $establ->cod_establec, ['class' => 'form-control', 'placeholder' => 'Código del establecimiento']) !!}
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
        <!-- /Modal Edición Código del establecimiendo -->

        <!-- Modal Edición Nombre -->
        <div class="modal fade" id="ModalNombre" tabindex="-1" role="dialog" aria-labelledby="nombreModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nombreModalLabel">Modificar nombre del establecimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-nombre-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('nom_establec', $establ->nom_establec, ['class' => 'form-control', 'placeholder' => 'Nombre del establecimiento']) !!}                        
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

        <!-- Modal Edición Nombre corto -->
        <div class="modal fade" id="ModalNombreCorto" tabindex="-1" role="dialog" aria-labelledby="nombreCortoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nombreCortoModalLabel">Modificar nombre corto del establecimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-nombre-corto-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('nom_corto_establec', $establ->nom_corto_establec, ['class' => 'form-control', 'placeholder' => 'Nombre corto del establecimiento']) !!}                        
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
        <!-- /Modal Edición Nombre corto -->

        <!-- Modal Edición teléfono -->
        <div class="modal fade" id="ModalTelefono" tabindex="-1" role="dialog" aria-labelledby="telefonoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="telefonoModalLabel">Modificar teléfono</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-telefono-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('telefono', $establ->telefono, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}                        
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
        <!-- /Modal Edición teléfono -->

        <!-- Modal Edición celular -->
        <div class="modal fade" id="ModalCelular" tabindex="-1" role="dialog" aria-labelledby="celularModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="celularModalLabel">Modificar celular</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-celular-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('celular', $establ->celular, ['class' => 'form-control', 'placeholder' => 'Celular']) !!}                        
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
        <!-- /Modal Edición celular -->

        <!-- Modal Edición dirección -->
        <div class="modal fade" id="ModalDireccion" tabindex="-1" role="dialog" aria-labelledby="direccionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="direccionModalLabel">Modificar dirección</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-direccion-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('direccion', $establ->direccion, ['class' => 'form-control', 'placeholder' => 'Dirección']) !!}                        
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
        <!-- /Modal Edición dirección -->

        <!-- Modal Edición correo -->
        <div class="modal fade" id="ModalCorreo" tabindex="-1" role="dialog" aria-labelledby="correoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correoModalLabel">Modificar correo eléctronico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-correo-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::text('correo', $establ->correo, ['class' => 'form-control', 'placeholder' => 'Correo eléctronico']) !!}                        
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

        <!-- Modal Edición tipo de establecimiento -->
        <div class="modal fade" id="ModalTipoEstabl" tabindex="-1" role="dialog" aria-labelledby="tipoestablModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tipoestablModalLabel">Modificar tipo de establecimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::model($establ, ['route' => ['modificar-tipo-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                    {{ Form::select('tipo_establec', $tipo_establec, $establ->tipo_establec, ['class'=>'form-control']) }}
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
        <!-- /Modal Edición tipo de establecimiento -->

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
                    {!! Form::model($establ, ['route' => ['modificar-estado-establecimiento', $establ->id], 'method' => 'PUT']) !!}
                    <div class="form-group">
                        {!! Form::select('estado', ['A' => 'Activo', 'B' => 'Bloqueado','E' => 'Eliminado'], $establ->estado, ['class'=>'form-control']) !!}
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
    <br /><h3>No hay datos con el nombre {{ $nom_establec }}.</h3>
    @endif

    </div>

</div>

@endsection
