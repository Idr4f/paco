<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>  


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    
    
        <a class="navbar-brand col-md-2 mr-0" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

        <button class="navbar-toggler col-sm-12" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>            
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <!-- Mostrar solo en móvil -->
                    <li class="nav-item dropdown d-block d-sm-none">
                        <a id="UsuariosnavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Usuarios <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="UsuariosnavbarDropdown">
                            <a class="dropdown-item" href="{{ route('agregar-usuario') }}">
                                Crear usuario
                            </a>
                            <a class="dropdown-item" href="{{ route('consultar-usuario') }}">
                                Consultar usuario
                            </a>
                            </a>
                            <a class="dropdown-item" href="{{ route('consultar-usuarios') }}">
                                Ver todos los usuarios
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown d-block d-sm-none">
                        <a id="RolOpnavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Roles <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="RolOpnavbarDropdown">
                            <a class="dropdown-item" href="#">
                                Crear rol
                            </a>
                            <a class="dropdown-item" href="#">
                                Editar rol
                            </a>
                            <a class="dropdown-item" href="#">
                                Consultar roles
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown d-block d-sm-none">
                        <a id="RolOpnavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Opciones <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="RolOpnavbarDropdown">
                            <a class="dropdown-item" href="#">
                                Crear opción
                            </a>
                            <a class="dropdown-item" href="#">
                                Editar opción
                            </a>
                            <a class="dropdown-item" href="#">
                                Consultar opciónes
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown d-block d-sm-none">
                        <a id="EstablenavbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Establecimientos <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="EstablenavbarDropdown">
                            <a class="dropdown-item" href="{{ route('agregar-establecimiento') }}">
                                Crear establecimiento
                            </a>                            
                            <a class="dropdown-item" href="#">
                                Editar establecimiento
                            </a>    
                            <a class="dropdown-item" href="{{ route('consultar-establecimientos') }}">
                                Consultar establecimientos
                            </a>                          
                        </div>
                    </li>

                    <!-- /Mostrar solo en móvil -->

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    
    </nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="{{ url('/') }}">
              <span data-feather="home"></span>
              Inicio <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Usuarios</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('agregar-usuario') }}">
              <span data-feather="file-text"></span>
              Crear usuario
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-usuario') }}">
              <span data-feather="file-text"></span>
              Consultar usuario
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-usuarios') }}">
              <span data-feather="file-text"></span>
              Ver todos los usuarios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-establecimiento-usuario') }}">
              <span data-feather="file-text"></span>
              Asociar Establecimiento - Rol
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Roles</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('agregar-rol') }}">
              <span data-feather="file-text"></span>
              Crear rol
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-rol') }}">
              <span data-feather="file-text"></span>
              Consultar rol
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-roles') }}">
              <span data-feather="file-text"></span>
              Ver todos los roles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-rol-opciones') }}">
              <span data-feather="file-text"></span>
              Asociar opción
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Opciones</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('agregar-opcion') }}">
              <span data-feather="file-text"></span>
              Crear opción
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-opcion') }}">
              <span data-feather="file-text"></span>
              Consultar opción
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-opciones') }}">
              <span data-feather="file-text"></span>
              Ver todas las opciones
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Establecimientos</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('agregar-establecimiento') }}">
              <span data-feather="file-text"></span>
              Crear establecimiento
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-establecimiento') }}">
              <span data-feather="file-text"></span>
              Consultar establecimiento
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('consultar-establecimientos') }}">
              <span data-feather="file-text"></span>
              Ver todos los establecimientos
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        
        @yield('content')

    </main>
  </div>
</div>

</html>
