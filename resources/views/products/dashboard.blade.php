@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-0 rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-dark fw-bold">
                <i class="bi bi-speedometer2 me-2 text-primary"></i>Panel de Gestión de Productos
            </h4>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">Bienvenido: <span class="fw-bold text-dark">{{ Auth::user()->user_name }}</span></span>
                <a href="{{ route('products.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i>Nuevo Producto
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4">Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th class="text-center pe-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="ps-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $product->name }}</div>
                                <span class="text-muted small">{{ Str::limit($product->description, 30) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $product->stock > 10 ? 'bg-info-subtle text-info' : 'bg-warning-subtle text-warning' }} px-3 py-2 rounded-pill fw-bold">
                                    {{ $product->stock }} unid.
                                </span>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-cart-plus me-1"></i>Añadir
                                        </button>
                                    </form>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                        <i class="bi bi-pencil me-1"></i>Editar
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('¿Estás seguro?')">
                                            <i class="bi bi-trash me-1"></i>Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No hay productos registrados aún.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection