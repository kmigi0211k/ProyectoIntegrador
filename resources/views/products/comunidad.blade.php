@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold text-primary">🤝 Mercado Solidario</h1>
            <p class="lead text-muted">Comunidad "12 de Octubre". Adquiere productos mediante compromiso de servicio social.</p>
        </div>
    </div>

    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 transition">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x200' }}" 
                         class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ $product->description }}</p>
                        <button type="button" class="btn btn-primary w-100 mt-3" data-bs-toggle="modal" data-bs-target="#vModal{{ $product->id }}">
                            Postularme
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="vModal{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('volunteers.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Postulación: {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3 text-start">
                                    <label class="form-label">Tipo de ayuda</label>
                                    <input type="text" name="help_type" class="form-control" required>
                                </div>
                                <div class="mb-3 text-start">
                                    <label class="form-label">Horas</label>
                                    <input type="number" name="hours_committed" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Confirmar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
