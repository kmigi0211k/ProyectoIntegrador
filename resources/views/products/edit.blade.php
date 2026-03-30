@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0 rounded-top-4">
                    <h4 class="mb-0 text-dark fw-bold text-center">
                        <i class="bi bi-pencil-square me-2 text-warning"></i>Editar Producto
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 text-center">
                            @if($product->image)
                                <div class="mb-3">
                                    <label class="form-label d-block fw-bold text-muted small">Imagen Actual</label>
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail shadow-sm rounded-3" style="max-height: 150px;">
                                </div>
                            @endif
                            <label class="form-label d-block fw-bold text-muted small">Cambiar Imagen (Opcional)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror shadow-sm rounded-pill">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" placeholder="Ej: Laptop Dell XPS">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Detalles del producto...">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Precio ($)</label>
                                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" placeholder="0.00">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stock</label>
                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" placeholder="0">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-warning btn-lg rounded-pill shadow-sm text-dark fw-bold">
                                <i class="bi bi-arrow-repeat me-2"></i>Actualizar Producto
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg rounded-pill">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection