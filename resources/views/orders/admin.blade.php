@extends('layouts.app')

@section('content')
<style>
    .dash-wrapper { background: #f8fafc; min-height: 100vh; padding: 32px 24px; }
    .page-topbar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
    .page-title { font-size: 26px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; }
    .page-title span { color: #10b981; }
    .page-sub { font-size: 13px; color: #94a3b8; margin-top: 4px; }

    .btn-back {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 10px;
        padding: 10px 18px; font-size: 13px; font-weight: 700; color: #64748b;
        text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .btn-back:hover { background: #f1f5f9; color: #334155; }

    /* Table Card */
    .table-card {
        background: #fff; border-radius: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.04);
        border: 1px solid #f1f5f9; overflow: hidden;
    }
    .table-header {
        padding: 20px 28px; border-bottom: 1px solid #f8fafc;
        display: flex; align-items: center; justify-content: space-between;
    }
    .table-title { font-size: 16px; font-weight: 800; color: #0f172a; }
    .table-count {
        font-size: 12px; color: #94a3b8; background: #f1f5f9;
        border-radius: 20px; padding: 4px 12px;
    }
    
    table { width: 100%; border-collapse: collapse; }
    thead th {
        background: #f8fafc; padding: 12px 16px; font-size: 11px; font-weight: 700;
        color: #64748b; text-transform: uppercase; letter-spacing: 0.7px;
        border-bottom: 1px solid #f1f5f9; text-align: left; white-space: nowrap;
    }
    tbody tr { border-bottom: 1px solid #f8fafc; transition: background 0.15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #fafbff; }
    tbody td { padding: 16px 16px; font-size: 13px; color: #334155; vertical-align: middle; }

    .user-chip { display: flex; align-items: center; gap: 10px; }
    .avatar {
        width: 38px; height: 38px; border-radius: 12px;
        background: linear-gradient(135deg, #10b981, #059669);
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .uname { font-weight: 700; color: #0f172a; font-size: 14px; }
    .uemail { font-size: 11px; color: #94a3b8; }

    .order-id { font-weight: 800; color: #0f172a; }
    .order-date { font-size: 12px; color: #94a3b8; margin-top: 3px; }

    .item-list { margin: 0; padding-left: 16px; font-size: 12px; color: #475569; }
    .item-list li { margin-bottom: 4px; }
    
    .badge-status {
        background: #eef2ff; color: #6366f1; border: 1px solid #c7d2fe;
        border-radius: 8px; padding: 5px 10px; font-size: 12px; font-weight: 700;
        display: inline-block;
    }
    .total-price { font-size: 16px; font-weight: 800; color: #16a34a; }

    .empty-row { text-align: center; padding: 70px 20px; }
    .empty-icon { font-size: 52px; margin-bottom: 14px; opacity: 0.3; }
</style>

<div class="dash-wrapper">
    <div class="container-fluid">
        <!-- Topbar -->
        <div class="page-topbar">
            <div>
                <div class="page-title">Historial de <span>Pedidos</span></div>
                <div class="page-sub">Revisa todas las compras realizadas por los clientes</div>
            </div>
            <a href="{{ route('products.dashboard') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Volver al Panel
            </a>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-header">
                <div class="table-title"><i class="bi bi-cart-check-fill text-success me-2"></i>Todos los Pedidos</div>
                <span class="table-count">{{ $orders->count() }} pedidos totales</span>
            </div>
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="padding-left:24px;">Pedido</th>
                            <th>Cliente</th>
                            <th>Detalle de Artículos</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th style="text-align:center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td style="padding-left:24px; width: 140px;">
                                <div class="order-id">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                                <div class="order-date">{{ $order->created_at->format('d/m/Y h:i A') }}</div>
                            </td>
                            <td>
                                <div class="user-chip">
                                    <div class="avatar">{{ strtoupper(substr($order->user->user_name ?? 'U', 0, 1)) }}</div>
                                    <div>
                                        <div class="uname">{{ $order->user->person->names ?? $order->user->user_name ?? 'Usuario eliminado' }}</div>
                                        <div class="uemail">{{ $order->user->person->email ?? 'Sin correo' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <ul class="item-list">
                                    @foreach($order->items as $item)
                                        <li><strong>{{ $item->quantity }}x</strong> {{ $item->product->name ?? 'Producto eliminado' }} <span class="text-muted">($ {{ number_format($item->price, 0, ',', '.') }} COP)</span></li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <span class="badge-status"><i class="bi bi-check-circle-fill me-1"></i>Completado</span>
                            </td>
                            <td>
                                <span class="total-price">$ {{ number_format($order->total, 0, ',', '.') }} COP</span>
                            </td>
                            <td style="text-align:center;">
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="order-del-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger rounded-3 btn-del-order">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-row">
                                    <div class="empty-icon">🛒</div>
                                    <strong style="font-size:16px; color:#475569;">Sin pedidos aún</strong>
                                    <p style="color:#94a3b8; margin-top:6px; font-size:13px;">Las compras realizadas por los clientes aparecerán aquí.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.btn-del-order').click(function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: '¿Eliminar historial?',
            text: 'Esta acción borrará el registro de la compra permanentemente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) { form.submit(); }
        });
    });
</script>
@endsection
