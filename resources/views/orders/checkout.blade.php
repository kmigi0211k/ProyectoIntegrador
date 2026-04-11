@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Información de Envío</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.process') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label text-secondary small">Nombre Completo</label>
                                <input type="text" class="form-control rounded-3" value="{{ Auth::user()->person->names ?? 'Usuario' }} {{ Auth::user()->person->last_name ?? '' }}" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Email</label>
                                <input type="email" class="form-control rounded-3" value="{{ Auth::user()->person->email ?? 'sin-email@dominio.com' }}" readonly disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Teléfono</label>
                                <input type="text" name="phone" class="form-control rounded-3" placeholder="+57 300 123 4567" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small">Dirección de Entrega</label>
                                <input type="text" name="address" class="form-control rounded-3" placeholder="Calle 123 #45-67" required>
                            </div>
                        </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Método de Pago</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="payment_method" id="cash" autocomplete="off" checked value="cash">
                            <label class="btn btn-outline-primary w-100 py-3 rounded-4" for="cash">
                                <i class="bi bi-cash-stack fs-3 d-block mb-2"></i>
                                <span class="fw-bold">Efectivo / Contra Entrega</span>
                                <p class="small mb-0 text-muted">Paga al recibir el producto</p>
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="radio" class="btn-check" name="payment_method" id="transfer" autocomplete="off" value="transfer">
                            <label class="btn btn-outline-primary w-100 py-3 rounded-4" for="transfer">
                                <i class="bi bi-bank fs-3 d-block mb-2"></i>
                                <span class="fw-bold">Transferencia / Nequi</span>
                                <p class="small mb-0 text-muted">Bancolombia, Nequi o Daviplata</p>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 2rem;">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Resumen del Pedido</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush small">
                        @foreach($cart as $id => $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 bg-transparent">
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $item['name'] }}</h6>
                                    <span class="text-muted">Cantidad: {{ $item['quantity'] }}</span>
                                </div>
                                <span class="fw-bold">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer bg-light border-0 py-3 rounded-bottom-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-success fw-bold">
                        <span>Envío</span>
                        <span>Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 mb-0 fw-bold">Total</span>
                        <span class="h5 mb-0 fw-bold text-primary">${{ number_format($total, 2) }}</span>
                    </div>
                    <button type="submit" form="checkout-form" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm fw-bold">
                        Confirmar Pedido <i class="bi bi-check-circle ms-2"></i>
                    </button>
                    <p class="text-center text-muted mt-3 small">
                        Al confirmar, aceptas nuestros términos y condiciones.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
