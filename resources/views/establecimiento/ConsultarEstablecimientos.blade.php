@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar establecimientos</h1>
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
                        <th>Nombre corto</th>
                        <th>Estado</th>      
                        <th style="width: 30%">Acción</th>                          
                    </tr>
                </thead>
                <tbody>
                @foreach ($establecimientos as $establecimiento)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $establecimiento->nom_establec }}</td>
                        <td>{{ $establecimiento->nom_corto_establec }}</td>
                        <td>
                        @if($establecimiento->estado == 'A')
                            Activo
                        @elseif($establecimiento->estado == 'B')
                            Bloqueado
                        @elseif($establecimiento->estado == 'E')
                            Eliminado
                        @endif
                        </td>     
                        <td>
                        
                            <a class="btn btn-primary mt-2 mt-md-0 mb-2 mb-md-0" href="{{ route('editar-establecimiento', ['id_establ' => $establecimiento->id]) }}">Editar</a>                                          
                                
                        </td>                   
                    </tr>
                @endforeach
                </tbody>
                </table>

                <!-- Paginación de tabla -->
                <div class="container col-md-12">
                    <div class="row mb-2 justify-content-center">
                    {{ $establecimientos->links() }}
                    </div>                
                </div>
                
            </div>
        <!-- Final tabla de consulta de usuarios -->
    </div>

</div>

@endsection
