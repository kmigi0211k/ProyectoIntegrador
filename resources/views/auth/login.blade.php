@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-dark py-4 text-center border-0">
                    <h4 class="mb-0 text-white fw-bold">Bienvenido</h4>
                    <p class="text-white-50 small mb-0">Inicia sesión para continuar</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <!-- Session Status -->
                    @if(session('status'))
                        <div class="alert alert-success small mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- User Name -->
                        <div class="mb-3">
                            <label for="user_name" class="form-label small fw-bold text-secondary">Nombre de Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">@</span>
                                <input id="user_name" type="text" name="user_name" class="form-control rounded-end-3 border-start-0 @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" required autofocus placeholder="tu_usuario">
                            </div>
                            @error('user_name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-bold text-secondary">Contraseña</label>
                            <input id="password" type="password" name="password" class="form-control rounded-3 @error('password') is-invalid @enderror" required placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label class="form-check-label small text-muted" for="remember_me">Recuérdame</label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg rounded-pill fw-bold shadow-sm">
                                Entrar
                            </button>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-3">
                                <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        @endif

                        <hr class="my-4">

                        <div class="text-center">
                            <span class="text-muted small">¿No tienes cuenta?</span>
                            <a href="{{ route('register') }}" class="small fw-bold text-decoration-none ms-1 text-primary">Regístrate</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
