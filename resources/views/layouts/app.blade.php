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

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-2">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                    <i class="bi bi-shop-window me-2 text-primary"></i>Productos<span class="text-primary">Pro</span>
                </a>

                <!-- Hamburger button for mobile/tablet -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse mt-2 mt-md-0" id="navbarMain">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto gap-1 mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('products.index') ? 'btn-primary' : 'btn-outline-light' }} px-3 py-2 fw-bold w-100 text-start" href="{{ route('products.index') }}">
                                <i class="bi bi-shop me-1"></i> Tienda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('products.comunidad') ? 'btn-primary' : 'btn-outline-light' }} px-3 py-2 fw-bold w-100 text-start" href="{{ route('products.comunidad') }}">
                                <i class="bi bi-heart-fill me-1 text-danger"></i> Voluntariado
                            </a>
                        </li>
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="btn {{ request()->routeIs('products.dashboard') ? 'btn-primary' : 'btn-outline-light' }} px-3 py-2 fw-bold w-100 text-start" href="{{ route('products.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Panel Admin
                            </a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right: Auth buttons -->
                    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 pb-2 pb-md-0">
                        @auth
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-light px-3 py-2 position-relative">
                                <i class="bi bi-cart3 fs-5"></i>
                                @if(session('cart') && count(session('cart')) > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                                        {{ count(session('cart')) }}
                                    </span>
                                @endif
                                <span class="ms-1 d-md-none">Carrito</span>
                            </a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('orders.admin') }}" class="btn btn-outline-light px-3 py-2 fw-bold">
                                    <i class="bi bi-cart-check-fill me-1"></i> Historial
                                </a>
                            @else
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-light px-3 py-2 fw-bold">
                                    <i class="bi bi-bag-check me-1"></i> Mis Compras
                                </a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-light px-3 py-2 fw-bold" id="btn-edit-profile">
                                <i class="bi bi-person me-1"></i> {{ Auth::user()->user_name }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                @csrf
                                <button type="submit" class="btn btn-danger px-3 py-2 fw-bold w-100" id="btn-logout">
                                    <i class="bi bi-box-arrow-right me-1"></i> Salir
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light px-4 py-2 fw-bold" id="btn-entrar">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fw-bold" id="btn-registro-nav">
                                <i class="bi bi-person-plus me-1"></i> Registro
                            </a>
                        @endauth
                    </div>
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
