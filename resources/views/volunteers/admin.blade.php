@extends('layouts.app')

@section('content')
<style>
    body { background: #0f1117 !important; }

    .page-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-title { font-size: 22px; font-weight: 800; color: #fff; }
    .page-subtitle { font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 3px; }

    .btn-back {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: all 0.2s;
    }

    .btn-back:hover { background: rgba(255,255,255,0.12); color: #fff; }

    /* Stats */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-mini {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 14px;
        padding: 18px 16px;
        text-align: center;
    }

    .stat-mini .num { font-size: 26px; font-weight: 800; color: #fff; }
    .stat-mini .lbl { font-size: 11px; color: rgba(255,255,255,0.4); margin-top: 4px; }
    .stat-mini.pending .num { color: #fbbf24; }
    .stat-mini.total .num { color: #818cf8; }
    .stat-mini.users .num { color: #34d399; }

    /* Table */
    .table-card {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        overflow: hidden;
    }

    .table-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .table-card-title { font-size: 15px; font-weight: 700; color: #fff; }

    .table { margin: 0; }

    .table thead th {
        background: rgba(0,0,0,0.2);
        color: rgba(255,255,255,0.35);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        border: none;
        padding: 13px 20px;
    }

    .table tbody tr { border-color: rgba(255,255,255,0.04); }
    .table tbody tr:hover { background: rgba(255,255,255,0.02); }

    .table tbody td {
        color: rgba(255,255,255,0.75);
        font-size: 13px;
        padding: 14px 20px;
        border-color: rgba(255,255,255,0.04);
        vertical-align: middle;
    }

    .user-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .avatar {
        width: 34px; height: 34px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .user-name { font-weight: 700; color: #f1f5f9; font-size: 14px; }

    .help-chip {
        background: rgba(99,102,241,0.12);
        border: 1px solid rgba(99,102,241,0.2);
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 600;
        color: #818cf8;
    }

    .hours-chip {
        background: rgba(16,185,129,0.12);
        border: 1px solid rgba(16,185,129,0.2);
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 700;
        color: #34d399;
    }

    .status-pending {
        background: rgba(245,158,11,0.15);
        border: 1px solid rgba(245,158,11,0.25);
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
        color: #fbbf24;
    }

    .product-chip {
        font-size: 13px;
        font-weight: 600;
        color: #c4b5fd;
    }

    .date-chip { font-size: 12px; color: rgba(255,255,255,0.35); }

    .empty-state {
        text-align: center;
        padding: 70px 20px;
        color: rgba(255,255,255,0.3);
    }

    .empty-state .icon { font-size: 52px; margin-bottom: 14px; opacity: 0.4; }
</style>

<div class="container-fluid px-4 py-4">

    <div class="page-header">
        <div>
            <div class="page-title">🤝 Panel de Voluntariado</div>
            <div class="page-subtitle">
                Gestiona todos los registros de voluntariado de la comunidad
            </div>
        </div>
        <a href="{{ route('products.dashboard') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Volver al Panel
        </a>
    </div>

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-mini total">
            <div class="num">{{ $volunteers->count() }}</div>
            <div class="lbl">Total Registros</div>
        </div>
        <div class="stat-mini pending">
            <div class="num">{{ $volunteers->where('status', 'pending')->count() }}</div>
            <div class="lbl">Pendientes</div>
        </div>
        <div class="stat-mini users">
            <div class="num">{{ $volunteers->pluck('user_id')->unique()->count() }}</div>
            <div class="lbl">Voluntarios Únicos</div>
        </div>
        <div class="stat-mini">
            <div class="num" style="color:#f87171;">{{ $volunteers->sum('hours_committed') }}</div>
            <div class="lbl">Horas Comprometidas</div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">Todos los Registros</div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="padding-left:24px;">#</th>
                        <th>Voluntario</th>
                        <th>Producto</th>
                        <th>Tipo de Ayuda</th>
                        <th>Horas</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($volunteers as $volunteer)
                    <tr>
                        <td style="padding-left:24px; color:rgba(255,255,255,0.3); font-size:12px;">
                            #{{ $volunteer->id }}
                        </td>
                        <td>
                            <div class="user-chip">
                                <div class="avatar">{{ strtoupper(substr($volunteer->user->user_name ?? 'U', 0, 1)) }}</div>
                                <div class="user-name">{{ $volunteer->user->user_name ?? 'Usuario eliminado' }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="product-chip">📦 {{ $volunteer->product->name ?? 'Producto eliminado' }}</span>
                        </td>
                        <td><span class="help-chip">{{ $volunteer->help_type }}</span></td>
                        <td><span class="hours-chip"><i class="bi bi-clock me-1"></i>{{ $volunteer->hours_committed }}h</span></td>
                        <td><span class="status-pending">⏳ {{ ucfirst($volunteer->status) }}</span></td>
                        <td><span class="date-chip">{{ $volunteer->created_at->format('d/m/Y') }}</span></td>
                        <td>
                            <span style="font-size:12px; color:rgba(255,255,255,0.4);">
                                {{ $volunteer->details ? Str::limit($volunteer->details, 30) : '—' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <div class="icon">🤝</div>
                                <h4 style="color:rgba(255,255,255,0.4); font-size:16px;">Aún no hay voluntarios registrados</h4>
                                <p style="font-size:13px; margin-top:6px;">Los registros aparecerán aquí cuando los usuarios se postulen.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
