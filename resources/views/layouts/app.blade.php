<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-box-seam me-2"></i>{{ config('app.name', 'ProductosPro') }}
                </a>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-shop me-1"></i>Tienda
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.dashboard') ? 'active' : '' }}" href="{{ route('products.dashboard') }}">
                            <i class="bi bi-speedometer2 me-1"></i>Panel
                        </a>
                    </li>
                    @endauth
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm position-relative">
                            <i class="bi bi-cart3 me-1"></i>Carrito
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-person me-1"></i>Perfil ({{ Auth::user()->user_name }})
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right me-1"></i>Cerrar Sesión
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-light btn-sm fw-bold">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
        
        <main>
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            @yield('content')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
