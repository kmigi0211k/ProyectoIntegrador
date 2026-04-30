<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Cuenta — ProductosPro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364, #1a1a2e);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
        }

        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body::before {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2), transparent 70%);
            border-radius: 50%;
            top: -150px; right: -150px;
            animation: float 9s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.2), transparent 70%);
            border-radius: 50%;
            bottom: -100px; left: -100px;
            animation: float 11s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-25px); }
        }

        .register-card {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 44px 40px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255,255,255,0.1);
            position: relative;
            z-index: 10;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .brand-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .brand-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.5);
        }

        .brand-name {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .brand-name span { color: #34d399; }

        .register-title {
            text-align: center;
            margin-bottom: 28px;
        }

        .register-title h1 {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 5px;
        }

        .register-title p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* Step indicator */
        .steps {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .step-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
        }

        .step-dot.active { background: #10b981; width: 24px; border-radius: 4px; }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 7px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .input-wrapper { position: relative; }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.35);
            font-size: 15px;
            z-index: 5;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #fff;
            padding: 12px 14px 12px 40px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder { color: rgba(255, 255, 255, 0.25); }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.11);
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
            color: #fff;
            outline: none;
        }

        .form-control.is-invalid { border-color: rgba(239, 68, 68, 0.6); }
        .text-danger { color: #f87171 !important; font-size: 12px; margin-top: 5px; }
        .invalid-feedback { color: #f87171; font-size: 12px; }

        .row-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(16, 185, 129, 0.55);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 20px 0 16px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.1);
        }

        .divider span { font-size: 12px; color: rgba(255,255,255,0.3); }

        .login-link {
            text-align: center;
            font-size: 14px;
            color: rgba(255,255,255,0.5);
        }

        .login-link a {
            color: #34d399;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover { color: #6ee7b7; text-decoration: underline; }

        .mb-field { margin-bottom: 16px; }

        @media (max-width: 480px) {
            .register-card { padding: 32px 22px; }
            .row-fields { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="register-card">

    <div class="brand-logo">
        <div class="brand-icon">🛍️</div>
        <div class="brand-name">Productos<span>Pro</span></div>
    </div>

    <div class="register-title">
        <h1>Crea tu cuenta gratis</h1>
        <p>Únete a la comunidad de ProductosPro</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre completo -->
        <div class="mb-field">
            <label for="names" class="form-label">Nombre Completo</label>
            <div class="input-wrapper">
                <i class="bi bi-person input-icon"></i>
                <input id="names" type="text" name="names"
                    class="form-control @error('names') is-invalid @enderror"
                    value="{{ old('names') }}" required autofocus placeholder="Juan Pérez">
            </div>
            @error('names')
                <div class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-field">
            <label for="email" class="form-label">Correo Electrónico</label>
            <div class="input-wrapper">
                <i class="bi bi-envelope input-icon"></i>
                <input id="email" type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required placeholder="juan@ejemplo.com">
            </div>
            @error('email')
                <div class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
            @enderror
        </div>

        <!-- Usuario -->
        <div class="mb-field">
            <label for="user_name" class="form-label">Nombre de Usuario</label>
            <div class="input-wrapper">
                <i class="bi bi-at input-icon"></i>
                <input id="user_name" type="text" name="user_name"
                    class="form-control @error('user_name') is-invalid @enderror"
                    value="{{ old('user_name') }}" required placeholder="juanperez123">
            </div>
            @error('user_name')
                <div class="text-danger"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
            @enderror
        </div>

        <!-- Contraseñas en 2 columnas -->
        <div class="row-fields mb-field">
            <div>
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required placeholder="••••••••">
                </div>
                @error('password')
                    <div class="text-danger" style="font-size:11px;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="password_confirmation" class="form-label">Confirmar</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="form-control" required placeholder="••••••••">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-register">
            <i class="bi bi-person-plus me-2"></i>Crear Cuenta Ahora
        </button>
    </form>

    <div class="divider"><span>¿Ya tienes cuenta?</span></div>

    <div class="login-link">
        <a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>Inicia Sesión</a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
