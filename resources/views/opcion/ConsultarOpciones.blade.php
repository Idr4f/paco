@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar opciones</h1>
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
                        <th>APP Establecimiento</th>
                        <th>APP Vecino</th>
                        <th>Estado</th>      
                        <th style="width: 30%">Acción</th>                          
                    </tr>
                </thead>
                <tbody>
                @foreach ($opciones as $opcion)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $opcion->nom_opcion }}</td>
                        <td>
                        @if($opcion->app_establec == 'S')
                            Sí
                        @elseif($opcion->app_establec == 'N')
                            No
                        @endif
                        </td> 
                        <td>
                        @if($opcion->app_miembro == 'S')
                        Sí
                        @elseif($opcion->app_miembro == 'N')
                        No
                        @endif
                        </td> 
                        <td>
                        @if($opcion->estado == 'A')
                            Activo
                        @elseif($opcion->estado == 'E')
                            Eliminado
                        @endif
                        </td>     
                        <td>
                        
                            <a class="btn btn-primary mt-2 mt-md-0 mb-2 mb-md-0" href="{{ route('editar-opcion', ['id_opcion' => $opcion->id]) }}">Editar</a>                                          
                                
                        </td>                   
                    </tr>
                @endforeach
                </tbody>
                </table>

                <!-- Paginación de tabla -->
                <div class="container col-md-12">
                    <div class="row mb-2 justify-content-center">
                    {{ $opciones->links() }}
                    </div>                
                </div>
                
            </div>
        <!-- Final tabla de consulta de usuarios -->
    </div>

</div>

@endsection
