@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center">
            <div class="card border-0 shadow-sm rounded-5 py-5 px-4 overflow-hidden position-relative">
                <!-- Decorative element -->
                <div class="position-absolute top-0 start-0 w-100 h-1 bg-success"></div>
                
                <div class="mb-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="bi bi-check-lg fs-1 text-success"></i>
                    </div>
                </div>
                
                <h2 class="fw-bold text-dark mb-2">¡Pedido Realizado con Éxito!</h2>
                <p class="text-secondary mb-5">Gracias por tu compra, <strong>{{ Auth::user()->person->names }}</strong>. Tu pedido #{{ $order->id }} está siendo procesado.</p>
                
                <div class="row text-start bg-light rounded-4 p-4 mb-5">
                    <div class="col-12 mb-3">
                        <h6 class="fw-bold text-uppercase small text-muted mb-0">Detalles del Pedido</h6>
                    </div>
                    @foreach($order->items as $item)
                        <div class="col-12 d-flex justify-content-between mb-2">
                            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                            <span class="fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                    <div class="col-12 border-top mt-3 pt-3 d-flex justify-content-between">
                        <span class="h5 fw-bold mb-0">Total Pagado</span>
                        <span class="h5 fw-bold mb-0 text-success">${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-bold">
                        <i class="bi bi-bag-plus me-2"></i>Seguir Comprando
                    </a>
                    <button onclick="window.print()" class="btn btn-outline-secondary btn-lg rounded-pill px-4 fw-bold">
                        <i class="bi bi-printer me-2"></i>Imprimir Recibo
                    </button>
                </div>
            </div>
            
            <p class="mt-4 text-muted small">
                Se ha enviado una confirmación a su correo electrónico: <strong>{{ Auth::user()->person->email }}</strong>
            </p>
        </div>
    </div>
</div>
@endsection
