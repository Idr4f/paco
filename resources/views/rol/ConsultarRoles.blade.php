@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar roles</h1>
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
                        <th>Estado</th>      
                        <th style="width: 10%">Acción</th>
                        <th style="width: 10%">Ver opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $rol)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $rol->nom_rol }}</td>
                        <td>
                        @if($rol->estado == 'A')
                            Activo
                        @elseif($rol->estado == 'E')
                            Eliminado
                        @endif
                        </td>     
                        <td>
                        
                            <a class="btn btn-primary mt-2 mt-md-0 mb-2 mb-md-0" href="{{ route('editar-rol', ['id_rol' => $rol->id]) }}">Editar</a>                                          
                                
                        </td>       
                        <td><a class="btn btn-primary mt-2 mt-md-0 mb-2 mb-md-0" href="{{ route('opciones-rol', ['nom_rol' => $rol->nom_rol]) }}">Ver</a></td>            
                    </tr>
                @endforeach
                </tbody>
                </table>

                <!-- Paginación de tabla -->
                <div class="container col-md-12">
                    <div class="row mb-2 justify-content-center">
                    {{ $roles->links() }}
                    </div>                
                </div>
                <!-- /Paginación de tabla -->
                
            </div>
        <!-- Final tabla de consulta de usuarios -->
    </div>

</div>

@endsection
