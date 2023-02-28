@extends('layouts.login')

@section('content')



<form class="form-signin" method="POST" action="{{ route('password.email') }}">
@csrf
    <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="250" height="151">
    <h1 class="h3 mb-3 font-weight-normal">Cambiar contraseña</h1>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="h3 mb-3 font-weight-normal">Ingresa tú Email</h2>
    <label for="usuario" class="sr-only">Ingresa tú Email</label>
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ingresa tú Email" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="mt-4">
            <button type="submit" class="btn btn-lg btn-primary btn-block">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
        <a class="btn btn-link" href="{{ route('login') }}">
            Volver atrás
        </a>

        <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
    
</form>
@endsection
