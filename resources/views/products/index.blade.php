@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold text-dark">Explora nuestros productos</h1>
            <p class="text-muted fs-5">Encuentra la mejor calidad y precios increíbles en un solo lugar.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('products.dashboard') }}" class="btn btn-dark rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-speedometer2 me-2"></i>Ir al Panel de Gestión
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card transition-all">
                <div class="position-relative">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $product->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-box-seam display-1 text-secondary opacity-25"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-dark rounded-pill shadow-sm px-3 py-2 fw-bold">
                            ${{ number_format($product->price, 2) }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>
                    <p class="card-text text-muted small mb-4">{{ Str::limit($product->description, 80) }}</p>
                    
                    <div class="d-flex align-items-center justify-content-between mt-auto">
                        <span class="text-muted small">
                            <i class="bi bi-archive me-1"></i>Stock: {{ $product->stock }}
                        </span>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;">
                                <i class="bi bi-cart-plus fs-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 mt-5">
            <div class="display-1 text-muted opacity-25 mb-4">
                <i class="bi bi-inbox-fill"></i>
            </div>
            <h3 class="text-muted">No hay productos disponibles por el momento</h3>
            <p class="text-muted">Vuelve más tarde o contacta con administración.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
