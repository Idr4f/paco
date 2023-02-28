<?php

use \App\Http\Controllers\usuariosController;

?>

@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar usuarios</h1>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">

        <!-- Tabla de consulta de usuarios -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>      
                        <th style="width: 30%">Acción</th>                          
                    </tr>
                </thead>
                <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        
                        @if(usuariosController::ConsultarRol($usuario->id) > 0)
                            <td>{{ usuariosController::ConsultarNomRol(usuariosController::ConsultarRol($usuario->id)) }}</td>
                        @else
                            <td>NA</td>
                        @endif               
                                                
                        <td>
                        @if($usuario->estado == 'A')
                            Activo
                        @elseif($usuario->estado == 'B')
                            Bloqueado
                        @elseif($usuario->estado == 'R')
                            Retirado
                        @endif
                        </td>     
                        <td>
                        
                            <a class="btn btn-primary mt-2 mt-md-0 mb-2 mb-md-0" href="{{ route('editar-usuario', ['id_usuario' => $usuario->id]) }}">Editar</a>                                          
                                
                        </td>                   
                    </tr>
                @endforeach
                </tbody>
                </table>

                <!-- Paginación de tabla -->
                <div class="container col-md-12">
                    <div class="row mb-2 justify-content-center">
                    {{ $usuarios->links() }}
                    </div>                
                </div>
                
            </div>
        <!-- Final tabla de consulta de usuarios -->
    </div>

</div>

@endsection
