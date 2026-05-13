@extends('layouts.app')

@section('content')
<div class="container py-5">
    <form action="{{ route('orders.process') }}" method="POST" id="checkout-form">
        @csrf
        <div class="row g-4">
            <!-- Lado Izquierdo: Información de Envío -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-4 border-0">
                        <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-truck me-2 text-primary"></i>Información de Envío</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label text-dark fw-bold small"><i class="bi bi-person me-1 text-primary"></i>Nombre Completo</label>
                                <input type="text" class="form-control form-control-lg rounded-3 bg-light" value="{{ Auth::user()->person->names ?? 'Usuario' }} {{ Auth::user()->person->last_name ?? '' }}" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-bold small"><i class="bi bi-envelope me-1 text-primary"></i>Email de Contacto</label>
                                <input type="email" class="form-control form-control-lg rounded-3 bg-light" value="{{ Auth::user()->person->email ?? 'sin-email@dominio.com' }}" readonly>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-bold small"><i class="bi bi-telephone me-1 text-primary"></i>Teléfono de Entrega</label>
                                <input type="text" name="phone" class="form-control form-control-lg rounded-3 border-primary" value="{{ Auth::user()->person->phone ?? '' }}" placeholder="Ej: 302 385 0997" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark fw-bold small"><i class="bi bi-geo-alt me-1 text-primary"></i>Dirección Exacta</label>
                                <textarea name="address" class="form-control form-control-lg rounded-3 border-primary" rows="2" placeholder="Ej: Calle 48 E # 93-53" required>{{ Auth::user()->person->address ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lado Derecho: Método de Pago y Resumen -->
            <div class="col-lg-5">
                <!-- Método de Pago -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-credit-card me-2 text-primary"></i>Método de Pago</h5>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row g-3">
                            <div class="col-sm-6 col-lg-12 col-xl-6">
                                <input type="radio" class="btn-check" name="payment_method" id="cash" autocomplete="off" checked value="cash">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-4 h-100 d-flex flex-column justify-content-center" for="cash">
                                    <i class="bi bi-cash-stack fs-3 d-block mb-1"></i>
                                    <span class="fw-bold">Contra Entrega</span>
                                    <span class="small d-block text-muted mt-1">Efectivo al recibir</span>
                                </label>
                            </div>
                            <div class="col-sm-6 col-lg-12 col-xl-6">
                                <input type="radio" class="btn-check" name="payment_method" id="transfer" autocomplete="off" value="transfer">
                                <label class="btn btn-outline-primary w-100 py-3 rounded-4 h-100 d-flex flex-column justify-content-center" for="transfer">
                                    <i class="bi bi-bank fs-3 d-block mb-1"></i>
                                    <span class="fw-bold">Transferencia</span>
                                    <span class="small d-block text-muted mt-1">Nequi o Daviplata</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resumen del Pedido -->
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 2rem;">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-receipt me-2 text-primary"></i>Resumen del Pedido</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush small">
                            @foreach($cart as $id => $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center py-3 bg-transparent px-4">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $item['name'] }}</h6>
                                        <span class="text-muted">Cantidad: {{ $item['quantity'] }}</span>
                                    </div>
                                    <span class="fw-bold">$ {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-light border-0 py-4 px-4 rounded-bottom-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>$ {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-success fw-bold">
                            <span>Envío</span>
                            <span>Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 mb-0 fw-bold">Total a Pagar</span>
                            <span class="h5 mb-0 fw-bold text-primary">$ {{ number_format($total, 0, ',', '.') }} COP</span>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill shadow-sm fw-bold fs-5">
                            Confirmar Pedido <i class="bi bi-check2-circle ms-2"></i>
                        </button>
                        <p class="text-center text-muted mt-3 mb-0 small">
                            Al confirmar, aceptas nuestros términos y condiciones.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
