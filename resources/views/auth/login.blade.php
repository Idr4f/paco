@extends('layouts.login')

@section('content')
<form class="form-signin" method="POST" action="{{ route('login') }}">
@csrf
@if (session('status'))
    <div class="alert alert-danger" role="alert">
        {{ session('status') }}
    </div>
@endif
    <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="250" height="252">
    <label for="usuario" class="sr-only">usuario</label>
        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    <label for="password" class="sr-only">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control mt-2 @error('password') is-invalid @enderror" placeholder="Contraseña" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
        </label>
        </div>
    <button class="btn btn-lg btn-primary-unidapp btn-block" type="submit">Ingresar</button>
    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
    <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
</form>
@endsection
