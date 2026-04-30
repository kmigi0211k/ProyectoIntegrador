@extends('layouts.app')

@section('content')
<style>
    body { background: #0f1117 !important; }

    .hero-section {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: 24px;
        padding: 52px 48px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.06);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(99,102,241,0.15), transparent 70%);
        border-radius: 50%;
        top: -100px; right: -100px;
    }

    .hero-section::after {
        content: '';
        position: absolute;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(139,92,246,0.1), transparent 70%);
        border-radius: 50%;
        bottom: -60px; left: 40%;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(99,102,241,0.15);
        border: 1px solid rgba(99,102,241,0.3);
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 12px;
        color: #818cf8;
        font-weight: 600;
        margin-bottom: 16px;
        letter-spacing: 0.5px;
    }

    .hero-title {
        font-size: 2.6rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        letter-spacing: -1px;
        margin-bottom: 12px;
    }

    .hero-title span {
        background: linear-gradient(135deg, #818cf8, #c084fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        color: rgba(255,255,255,0.5);
        font-size: 15px;
        margin-bottom: 0;
        max-width: 420px;
    }

    .btn-panel {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        color: #fff;
        border-radius: 12px;
        padding: 12px 22px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .btn-panel:hover {
        background: rgba(99,102,241,0.3);
        border-color: rgba(99,102,241,0.5);
        color: #fff;
        transform: translateY(-2px);
    }

    /* Stats bar */
    .stats-bar {
        display: flex;
        gap: 32px;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid rgba(255,255,255,0.07);
    }

    .stat-item { text-align: left; }
    .stat-number {
        font-size: 22px;
        font-weight: 800;
        color: #fff;
    }
    .stat-label {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        margin-top: 2px;
    }

    /* Filter bar */
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #fff;
    }

    .section-subtitle {
        font-size: 13px;
        color: rgba(255,255,255,0.4);
        margin-top: 2px;
    }

    /* Product Cards */
    .product-card {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        border-color: rgba(99,102,241,0.4);
        box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(99,102,241,0.2);
    }

    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        height: 210px;
    }

    .product-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image-wrapper img {
        transform: scale(1.08);
    }

    .product-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #1e2130, #252840);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        opacity: 0.4;
    }

    .price-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        background: rgba(0,0,0,0.75);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 10px;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 800;
        color: #fff;
    }

    .stock-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
    }

    .stock-ok { background: rgba(16,185,129,0.2); color: #34d399; border: 1px solid rgba(16,185,129,0.3); }
    .stock-low { background: rgba(245,158,11,0.2); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3); }
    .stock-out { background: rgba(239,68,68,0.2); color: #f87171; border: 1px solid rgba(239,68,68,0.3); }

    .product-body {
        padding: 20px;
    }

    .product-name {
        font-size: 15px;
        font-weight: 700;
        color: #f1f5f9;
        margin-bottom: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-desc {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        line-height: 1.5;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        border-top: 1px solid rgba(255,255,255,0.05);
        background: rgba(0,0,0,0.15);
    }

    .stock-info {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-add-cart {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 10px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99,102,241,0.3);
    }

    .btn-add-cart:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(99,102,241,0.5);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: rgba(255,255,255,0.3);
    }

    .empty-state .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 20px;
        font-weight: 700;
        color: rgba(255,255,255,0.5);
        margin-bottom: 8px;
    }

    .empty-state p { font-size: 14px; }

    /* Alert override */
    .alert-success {
        background: rgba(16,185,129,0.12);
        border: 1px solid rgba(16,185,129,0.25);
        color: #6ee7b7;
        border-radius: 12px;
    }
</style>

<div class="container-fluid px-4 py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hero Section -->
    <div class="hero-section mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-badge">
                    <i class="bi bi-stars"></i> Catálogo Oficial
                </div>
                <h1 class="hero-title">
                    Explora nuestros<br><span>productos</span>
                </h1>
                <p class="hero-subtitle">
                    Encuentra la mejor calidad y precios increíbles en un solo lugar. 
                    Más de {{ $products->count() }} productos disponibles para ti.
                </p>
                <div class="stats-bar">
                    <div class="stat-item">
                        <div class="stat-number">{{ $products->count() }}</div>
                        <div class="stat-label">Productos</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ $products->where('stock', '>', 0)->count() }}</div>
                        <div class="stat-label">En Stock</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Disponible</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('products.dashboard') }}" class="btn-panel">
                    <i class="bi bi-speedometer2"></i> Panel de Gestión
                </a>
            </div>
        </div>
    </div>

    <!-- Filter bar -->
    <div class="filter-bar">
        <div>
            <div class="section-title">Todos los Productos</div>
            <div class="section-subtitle">Mostrando {{ $products->count() }} resultados</div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="product-card">
                <div class="product-image-wrapper">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="product-placeholder">📦</div>
                    @endif

                    <div class="price-badge">${{ number_format($product->price, 0, ',', '.') }}</div>

                    @if($product->stock > 10)
                        <div class="stock-badge stock-ok"><i class="bi bi-check2"></i> Disponible</div>
                    @elseif($product->stock > 0)
                        <div class="stock-badge stock-low"><i class="bi bi-exclamation"></i> Últimas unidades</div>
                    @else
                        <div class="stock-badge stock-out"><i class="bi bi-x"></i> Agotado</div>
                    @endif
                </div>

                <div class="product-body">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-desc">{{ $product->description }}</div>
                </div>

                <div class="product-footer">
                    <div class="stock-info">
                        <i class="bi bi-archive"></i> {{ $product->stock }} unidades
                    </div>
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-add-cart">
                                <i class="bi bi-cart-plus"></i> Añadir
                            </button>
                        </form>
                    @else
                        <span style="font-size:12px; color: #f87171; font-weight:600;">Sin stock</span>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-icon">📭</div>
                <h3>No hay productos disponibles</h3>
                <p>Vuelve más tarde o contacta con el administrador.</p>
            </div>
        </div>
        @endforelse
    </div>

</div>
@endsection
