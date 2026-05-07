@extends('layouts.app')

@section('content')
<style>
    body { background-color: #f4f7f9 !important; }
    
    .profile-hero {
        background-color: #004b93; /* Azul Alkosto */
        color: white;
        padding: 40px 25px 80px 25px;
        margin-bottom: -60px;
        position: relative;
    }

    .profile-hero h1 {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .profile-hero p {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .profile-grid {
        padding: 0 15px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 20px;
    }

    .profile-card {
        background: white;
        border-radius: 12px;
        padding: 20px 15px;
        text-align: left;
        text-decoration: none;
        color: #333;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #eee;
        min-height: 150px;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        color: #004b93;
    }

    .card-icon {
        font-size: 28px;
        color: #004b93;
        margin-bottom: 15px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .card-desc {
        font-size: 12px;
        color: #666;
        line-height: 1.4;
    }

    .logout-section {
        margin-top: 40px;
        padding: 0 15px 40px 15px;
    }

    .btn-logout-alt {
        width: 100%;
        background: white;
        color: #e11d48;
        border: 1px solid #fb7185;
        padding: 12px;
        border-radius: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
    }

    .btn-logout-alt:hover {
        background: #fff1f2;
    }

    @media (max-width: 576px) {
        .profile-grid {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>

<div class="profile-hero">
    <div class="container">
        <h1><i class="bi bi-person-circle me-2"></i>Mi cuenta</h1>
        <h3>¡Hola, {{ Auth::user()->user_name }}!</h3>
        <p>Aquí podrás consultar todos tus movimientos y gestionar tu información.</p>
    </div>
</div>

<div class="container">
    <div class="profile-grid">
        <!-- Mi Perfil -->
        <a href="#" class="profile-card" onclick="alert('Función de edición en desarrollo para la entrega final')">
            <div>
                <div class="card-icon"><i class="bi bi-person-vcard"></i></div>
                <div class="card-title">Mi Perfil</div>
                <div class="card-desc">Revisa y edita tus datos personales, contraseña y seguridad.</div>
            </div>
        </a>

        <!-- Direcciones de envío (Simulado como Compras) -->
        <a href="{{ route('orders.index') }}" class="profile-card">
            <div>
                <div class="card-icon"><i class="bi bi-box-seam"></i></div>
                <div class="card-title">Mis Pedidos</div>
                <div class="card-desc">Gestiona tus pedidos realizados, historial y estados de entrega.</div>
            </div>
        </a>

        <!-- Voluntariados -->
        <a href="{{ route('volunteers.myApplications') }}" class="profile-card">
            <div>
                <div class="card-icon"><i class="bi bi-heart-fill"></i></div>
                <div class="card-title">Voluntariados</div>
                <div class="card-desc">Consulta el estado de tus postulaciones en el Barrio 12 de Octubre.</div>
            </div>
        </a>

        <!-- Carrito -->
        <a href="{{ route('cart.index') }}" class="profile-card">
            <div>
                <div class="card-icon"><i class="bi bi-cart3"></i></div>
                <div class="card-title">Mi Carrito</div>
                <div class="card-desc">Finaliza la compra de los productos que tienes seleccionados.</div>
            </div>
        </a>
    </div>

    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout-alt">
                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</div>
@endsection
