@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Especial Comunidad -->
    <div class="row mb-5 bg-success text-white rounded-4 p-4 p-md-5 shadow align-items-center" style="background: linear-gradient(135deg, #198754 0%, #20c997 100%);">
        <div class="col-md-8">
            <h1 class="display-4 fw-bold mb-3"><i class="bi bi-houses-fill me-3"></i>Comunidad 12 de Octubre</h1>
            <p class="fs-5 mb-0">Esta sección es un espacio dedicado a nuestra visita al barrio 12 de Octubre. Como muestra de nuestro apoyo a la comunidad, aquí podrás encontrar nuestros productos con precios solidarios y beneficios exclusivos.</p>
        </div>
        <div class="col-md-4 text-md-end mt-4 mt-md-0 text-center">
            <i class="bi bi-heart-fill text-white opacity-75" style="font-size: 5rem;"></i>
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
                    <div class="position-absolute top-0 end-0 m-3 d-flex flex-column align-items-end">
                        <span class="badge bg-primary text-white rounded-pill shadow-sm px-3 py-2 fw-bold fs-6">
                            <i class="bi bi-heart-fill me-1 text-danger"></i> Solidaridad
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>
                    <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 80) }}</p>
                    
                    <div class="alert alert-primary py-2 px-3 small rounded-3 mb-4 border-0 bg-primary bg-opacity-10 text-primary text-darken text-center">
                        <strong><i class="bi bi-person-arms-up me-1"></i> Intercambio por Trabajo Social:</strong> <br>
                        Llévalo a cambio de {{ max(1, floor($product->price / 100000)) }} hora(s) de ayuda al barrio.
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-auto">
                        <span class="text-muted small">
                            <i class="bi bi-archive me-1"></i>Stock: {{ $product->stock }}
                        </span>
                        <button type="button" class="btn btn-primary rounded-pill px-3 py-2 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#volunteerModal{{ $product->id }}">
                            <i class="bi bi-people-fill me-1"></i> Quiero Ayudar
                        </button>
                    </div>


                </div>
            </div>

            <!-- Modal de Banco de Voluntariado -->
            <div class="modal fade" id="volunteerModal{{ $product->id }}" tabindex="-1" aria-labelledby="volunteerModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <form action="{{ route('volunteers.store', $product->id) }}" method="POST">
                            @csrf
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold text-primary" id="volunteerModalLabel{{ $product->id }}">
                                    <i class="bi bi-heart-fill me-2 text-danger"></i>Compromiso Social
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted small mb-4">Estás solicitando: <strong>{{ $product->name }}</strong></p>
                                
                                <div class="mb-3">
                                    <label for="help_type" class="form-label fw-bold">¿Cómo quieres ayudar al barrio?</label>
                                    <select class="form-select rounded-3" name="help_type" id="help_type" required>
                                        <option value="" selected disabled>Selecciona una opción...</option>
                                        <option value="Limpieza de calles/parques">Limpieza de calles o parques</option>
                                        <option value="Tutorias escolares">Dar tutorías a niños del barrio</option>
                                        <option value="Comedor comunitario">Apoyar en el comedor comunitario</option>
                                        <option value="Cuidado de adultos mayores">Acompañamiento a adultos mayores</option>
                                        <option value="Otro">Otra forma de ayuda</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="hours_committed" class="form-label fw-bold">Horas que te comprometes a donar</label>
                                    <input type="number" class="form-control rounded-3" name="hours_committed" id="hours_committed" min="1" max="100" value="{{ max(1, floor($product->price / 100000)) }}" required>
                                    <div class="form-text">El sistema sugiere horas según el valor del producto, pero puedes donar más si lo deseas.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="details" class="form-label fw-bold">Detalles adicionales (Opcional)</label>
                                    <textarea class="form-control rounded-3" name="details" id="details" rows="2" placeholder="Ej: Puedo ayudar los fines de semana en las mañanas..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Me Comprometo</button>
                            </div>
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
        </div>
        @endforelse
    </div>
</div>

<style>
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.15) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
