@extends('layouts.app')

@section('content')
<style>
    body { background: #0f1117 !important; }

    .dash-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dash-title { font-size: 22px; font-weight: 800; color: #fff; }
    .dash-subtitle { font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 3px; }

    .btn-new {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        border-radius: 12px;
        padding: 11px 22px;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99,102,241,0.35);
    }

    .btn-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99,102,241,0.5);
        color: #fff;
    }

    /* Stats cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 16px;
        padding: 22px 20px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 80px; height: 80px;
        border-radius: 50%;
        opacity: 0.08;
    }

    .stat-card.blue::before { background: #6366f1; }
    .stat-card.green::before { background: #10b981; }
    .stat-card.amber::before { background: #f59e0b; }
    .stat-card.red::before { background: #ef4444; }

    .stat-icon {
        font-size: 20px;
        margin-bottom: 12px;
    }

    .stat-card.blue .stat-icon { color: #818cf8; }
    .stat-card.green .stat-icon { color: #34d399; }
    .stat-card.amber .stat-icon { color: #fbbf24; }
    .stat-card.red .stat-icon { color: #f87171; }

    .stat-value { font-size: 28px; font-weight: 800; color: #fff; }
    .stat-label { font-size: 12px; color: rgba(255,255,255,0.4); margin-top: 4px; }

    /* Table */
    .table-card {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        overflow: hidden;
    }

    .table-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-card-title { font-size: 16px; font-weight: 700; color: #fff; }

    .table { margin: 0; }
    .table thead th {
        background: rgba(0,0,0,0.2);
        color: rgba(255,255,255,0.4);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        border: none;
        padding: 14px 20px;
    }

    .table tbody tr {
        border-color: rgba(255,255,255,0.04);
        transition: background 0.2s;
    }

    .table tbody tr:hover { background: rgba(255,255,255,0.03); }

    .table tbody td {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
        padding: 16px 20px;
        border-color: rgba(255,255,255,0.04);
        vertical-align: middle;
    }

    .product-thumb {
        width: 48px; height: 48px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .product-thumb-placeholder {
        width: 48px; height: 48px;
        border-radius: 10px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        opacity: 0.5;
    }

    .product-info-name { font-weight: 700; color: #f1f5f9; font-size: 14px; }
    .product-info-desc { font-size: 12px; color: rgba(255,255,255,0.35); margin-top: 2px; }

    .badge-price {
        background: rgba(16,185,129,0.15);
        color: #34d399;
        border: 1px solid rgba(16,185,129,0.25);
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 13px;
        font-weight: 700;
    }

    .badge-stock-ok {
        background: rgba(99,102,241,0.15);
        color: #818cf8;
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-stock-low {
        background: rgba(245,158,11,0.15);
        color: #fbbf24;
        border: 1px solid rgba(245,158,11,0.2);
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-action {
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
    }

    .btn-edit {
        background: rgba(99,102,241,0.15);
        color: #818cf8;
        border: 1px solid rgba(99,102,241,0.2);
    }

    .btn-edit:hover { background: rgba(99,102,241,0.3); color: #a5b4fc; }

    .btn-delete-action {
        background: rgba(239,68,68,0.12);
        color: #f87171;
        border: 1px solid rgba(239,68,68,0.2);
    }

    .btn-delete-action:hover { background: rgba(239,68,68,0.25); color: #fca5a5; }

    .btn-cart-action {
        background: rgba(16,185,129,0.12);
        color: #34d399;
        border: 1px solid rgba(16,185,129,0.2);
    }

    .btn-cart-action:hover { background: rgba(16,185,129,0.25); color: #6ee7b7; }

    .empty-row td {
        text-align: center;
        padding: 60px 20px;
        color: rgba(255,255,255,0.3);
    }

    .alert-success {
        background: rgba(16,185,129,0.12);
        border: 1px solid rgba(16,185,129,0.25);
        color: #6ee7b7;
        border-radius: 12px;
    }

    .btn-volunteers-link {
        background: rgba(251,191,36,0.12);
        border: 1px solid rgba(251,191,36,0.25);
        color: #fbbf24;
        border-radius: 10px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: all 0.2s;
    }

    .btn-volunteers-link:hover {
        background: rgba(251,191,36,0.25);
        color: #fde68a;
    }
</style>

<div class="container-fluid px-4 py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="dash-header">
        <div>
            <div class="dash-title">⚡ Panel de Gestión</div>
            <div class="dash-subtitle">Bienvenido, <strong style="color:#fff;">{{ Auth::user()->user_name }}</strong> — Administra tus productos</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('volunteers.admin') }}" class="btn-volunteers-link">
                <i class="bi bi-people-fill"></i> Ver Voluntarios
            </a>
            <a href="{{ route('products.create') }}" class="btn-new">
                <i class="bi bi-plus-lg"></i> Nuevo Producto
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon"><i class="bi bi-box-seam-fill"></i></div>
            <div class="stat-value">{{ $products->count() }}</div>
            <div class="stat-label">Total Productos</div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-value">{{ $products->where('stock', '>', 0)->count() }}</div>
            <div class="stat-label">En Stock</div>
        </div>
        <div class="stat-card amber">
            <div class="stat-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div class="stat-value">{{ $products->where('stock', '<=', 5)->where('stock', '>', 0)->count() }}</div>
            <div class="stat-label">Stock Bajo</div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon"><i class="bi bi-x-circle-fill"></i></div>
            <div class="stat-value">{{ $products->where('stock', 0)->count() }}</div>
            <div class="stat-label">Sin Stock</div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">Lista de Productos</div>
            <span style="font-size:12px; color:rgba(255,255,255,0.3);">{{ $products->count() }} registros</span>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">Producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td style="padding-left:24px;">
                            <div class="d-flex align-items-center gap-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-thumb">
                                @else
                                    <div class="product-thumb-placeholder">📦</div>
                                @endif
                                <div>
                                    <div class="product-info-name">{{ $product->name }}</div>
                                    <div class="product-info-desc">{{ Str::limit($product->description, 40) }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge-price">${{ number_format($product->price, 0, ',', '.') }}</span></td>
                        <td>
                            @if($product->stock > 5)
                                <span class="badge-stock-ok"><i class="bi bi-archive me-1"></i>{{ $product->stock }}</span>
                            @else
                                <span class="badge-stock-low"><i class="bi bi-exclamation me-1"></i>{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-action btn-cart-action">
                                        <i class="bi bi-cart-plus"></i> Añadir
                                    </button>
                                </form>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-action btn-delete-action btn-delete">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="4">
                            <div style="font-size:40px; margin-bottom:12px;">📭</div>
                            <div style="font-weight:700; color:rgba(255,255,255,0.4); margin-bottom:6px;">No hay productos registrados</div>
                            <a href="{{ route('products.create') }}" class="btn-new" style="display:inline-flex; margin-top:8px;">
                                <i class="bi bi-plus-lg"></i> Crear primer producto
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: '¿Eliminar producto?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            background: '#1a1d2e',
            color: '#fff',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#374151',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) { form.submit(); }
        });
    });
</script>
@endsection