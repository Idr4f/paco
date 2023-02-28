@extends('layouts.login')

@section('content')
<form class="form-signin" method="POST" action="{{ route('password.update') }}">
@csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="250" height="151">
    <h1 class="h3 mb-3 font-weight-normal">Ingresar</h1>
    <label for="inputEmail" class="sr-only">Ingresa tú correo</label>
        
        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ingresa tú correo" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $email }}</strong>
            </span>
        @enderror
    <label for="password" class="sr-only">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control mt-2 @error('password') is-invalid @enderror" placeholder="Contraseña" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    <label for="password-confirm" class="sr-only">Confirmar contraseña</label>
        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required autocomplete="new-password">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
    <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
</form>
@endsection
