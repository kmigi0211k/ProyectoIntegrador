@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary py-4 text-center border-0">
                    <h4 class="mb-0 text-white fw-bold">Crea tu Cuenta</h4>
                    <p class="text-white-50 small mb-0">Únete a ProductosPro hoy mismo</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Names -->
                        <div class="mb-3">
                            <label for="names" class="form-label small fw-bold text-secondary">Nombre Completo</label>
                            <input id="names" type="text" name="names" class="form-control rounded-3 @error('names') is-invalid @enderror" value="{{ old('names') }}" required autofocus placeholder="Ej: Juan Pérez">
                            @error('names')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-secondary">Correo Electrónico</label>
                            <input id="email" type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="juan@ejemplo.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- User Name -->
                        <div class="mb-3">
                            <label for="user_name" class="form-label small fw-bold text-secondary">Nombre de Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3 text-muted">@</span>
                                <input id="user_name" type="text" name="user_name" class="form-control rounded-end-3 border-start-0 @error('user_name') is-invalid @enderror" value="{{ old('user_name') }}" required placeholder="juanperez123">
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

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label small fw-bold text-secondary">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control rounded-3" required placeholder="••••••••">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm">
                                Registrarse Ahora
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <span class="text-muted small">¿Ya tienes cuenta?</span>
                            <a href="{{ route('login') }}" class="small fw-bold text-decoration-none ms-1">Inicia Sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
