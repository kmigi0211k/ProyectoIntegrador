@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-0 rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-dark fw-bold">
                <i class="bi bi-cart3 me-2 text-primary"></i>Tu Carrito
            </h4>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i>Seguir Comprando
            </a>
        </div>
        <div class="card-body p-0">
            @if(session('cart') && count(session('cart')) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase fw-bold">
                            <tr>
                                <th class="ps-4">Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th class="text-center pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" class="rounded shadow-sm me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center border me-3" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div class="fw-bold text-dark">{{ $details['name'] }}</div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($details['price'], 2) }}</td>
                                    <td>
                                        <input type="number" value="{{ $details['quantity'] }}" class="form-control form-control-sm text-center quantity update-cart" data-id="{{ $id }}" style="width: 70px;">
                                    </td>
                                    <td class="fw-bold text-dark">
                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </td>
                                    <td class="pe-4 text-center">
                                        <button class="btn btn-outline-danger btn-sm rounded-pill px-3 remove-from-cart" data-id="{{ $id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold ps-4">Total:</td>
                                <td colspan="2" class="fw-bold text-primary fs-5 pe-4 ps-1">
                                    ${{ number_format($total, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer bg-white border-0 py-3 rounded-bottom-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('cart.clear') }}" class="btn btn-link text-danger text-decoration-none small" onclick="return confirm('¿Vaciar carrito?')">
                        Vaciar Carrito
                    </a>
                    <a href="{{ route('orders.checkout') }}" class="btn btn-success rounded-pill px-4 shadow-sm fw-bold">
                        Proceder al Pago <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-cart-x fs-1 d-block mb-3"></i>
                    <p class="mb-4">Tu carrito está vacío.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4">
                        Ver Productos
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.attr("data-id"), 
                quantity: ele.val()
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("¿Eliminar producto?")) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
