@extends('layouts.app')

@section('content')
<style>
    body { background: #0f1117 !important; }

    .community-hero {
        background: linear-gradient(135deg, #0d1b2a, #1b2838, #0f3460);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 24px;
        padding: 52px 48px;
        margin-bottom: 36px;
        position: relative;
        overflow: hidden;
    }

    .community-hero::before {
        content: '';
        position: absolute;
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(16,185,129,0.12), transparent 70%);
        border-radius: 50%;
        top: -80px; right: -80px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(16,185,129,0.12);
        border: 1px solid rgba(16,185,129,0.25);
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 12px;
        color: #34d399;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .hero-title {
        font-size: 2.4rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.2;
        letter-spacing: -0.5px;
        margin-bottom: 12px;
    }

    .hero-title span {
        background: linear-gradient(135deg, #34d399, #059669);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-desc {
        color: rgba(255,255,255,0.5);
        font-size: 15px;
        max-width: 500px;
        line-height: 1.6;
    }

    .how-it-works {
        display: flex;
        gap: 24px;
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid rgba(255,255,255,0.07);
        flex-wrap: wrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: rgba(255,255,255,0.5);
    }

    .step-num {
        width: 28px; height: 28px;
        background: rgba(16,185,129,0.15);
        border: 1px solid rgba(16,185,129,0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: #34d399;
        flex-shrink: 0;
    }

    /* Cards */
    .volunteer-card {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .volunteer-card:hover {
        transform: translateY(-8px);
        border-color: rgba(16,185,129,0.35);
        box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(16,185,129,0.15);
    }

    .card-img-wrap {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .card-img-wrap img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .volunteer-card:hover .card-img-wrap img { transform: scale(1.08); }

    .card-img-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #1e2130, #252840);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 56px;
        opacity: 0.4;
    }

    .solidarity-badge {
        position: absolute;
        top: 14px; left: 14px;
        background: rgba(16,185,129,0.2);
        border: 1px solid rgba(16,185,129,0.35);
        backdrop-filter: blur(10px);
        border-radius: 8px;
        padding: 5px 10px;
        font-size: 11px;
        font-weight: 700;
        color: #34d399;
    }

    .card-body-custom {
        padding: 20px;
    }

    .product-name {
        font-size: 16px;
        font-weight: 700;
        color: #f1f5f9;
        margin-bottom: 6px;
    }

    .product-desc {
        font-size: 12px;
        color: rgba(255,255,255,0.4);
        line-height: 1.5;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .btn-postulate {
        width: 100%;
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 12px;
        padding: 12px;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16,185,129,0.3);
    }

    .btn-postulate:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16,185,129,0.5);
    }

    /* Modal */
    .modal-content {
        background: #1a1d2e;
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        color: #fff;
    }

    .modal-header {
        border-color: rgba(255,255,255,0.07);
        padding: 20px 24px;
    }

    .modal-title { font-weight: 700; font-size: 16px; }
    .btn-close { filter: invert(1); }

    .modal-body { padding: 24px; }
    .modal-footer {
        border-color: rgba(255,255,255,0.07);
        padding: 16px 24px;
    }

    .form-label-modal {
        font-size: 11px;
        font-weight: 700;
        color: rgba(255,255,255,0.5);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 7px;
    }

    .form-control-dark {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        color: #fff;
        padding: 11px 14px;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s;
    }

    .form-control-dark::placeholder { color: rgba(255,255,255,0.25); }
    .form-control-dark:focus {
        outline: none;
        border-color: rgba(16,185,129,0.5);
        box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
        background: rgba(255,255,255,0.1);
        color: #fff;
    }

    .btn-confirm {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 10px;
        padding: 11px 24px;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-confirm:hover { opacity: 0.9; transform: translateY(-1px); }

    .btn-cancel-modal {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        padding: 11px 20px;
        font-size: 14px;
        color: rgba(255,255,255,0.6);
        cursor: pointer;
        transition: all 0.2s;
    }

    .section-header { margin-bottom: 24px; }
    .section-title { font-size: 18px; font-weight: 700; color: #fff; }
    .section-sub { font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 3px; }
</style>

<div class="container-fluid px-4 py-4">

    <!-- Hero -->
    <div class="community-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-badge"><i class="bi bi-heart-fill"></i> Comunidad "12 de Octubre"</div>
                <h1 class="hero-title">Mercado<br><span>Solidario</span></h1>
                <p class="hero-desc">
                    Adquiere productos sin costo monetario comprometiendo horas de servicio 
                    a nuestra comunidad. Juntos construimos un barrio mejor.
                </p>
                <div class="how-it-works">
                    <div class="step">
                        <div class="step-num">1</div>
                        <span>Elige un producto</span>
                    </div>
                    <div class="step">
                        <div class="step-num">2</div>
                        <span>Define tu tipo de ayuda y horas</span>
                    </div>
                    <div class="step">
                        <div class="step-num">3</div>
                        <span>Coordina por WhatsApp</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->
    <div class="section-header">
        <div class="section-title">Productos Disponibles</div>
        <div class="section-sub">{{ $products->count() }} productos disponibles para voluntariado</div>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="volunteer-card">
                <div class="card-img-wrap">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="card-img-placeholder">🌿</div>
                    @endif
                    <div class="solidarity-badge"><i class="bi bi-heart me-1"></i>Solidario</div>
                </div>

                <div class="card-body-custom">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-desc">{{ $product->description }}</div>

                    @auth
                        <button type="button" class="btn-postulate"
                            data-bs-toggle="modal" data-bs-target="#vModal{{ $product->id }}">
                            <i class="bi bi-hand-thumbs-up-fill"></i> Postularme como Voluntario
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn-postulate" style="text-decoration:none;">
                            <i class="bi bi-box-arrow-in-right"></i> Inicia sesión para postularte
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Modal de Voluntariado -->
        @auth
        <div class="modal fade" id="vModal{{ $product->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('volunteers.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-heart-fill text-success me-2"></i>
                                Postulación: {{ $product->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label-modal">¿Cómo quieres ayudar?</label>
                                <select name="help_type" class="form-control-dark" required>
                                    <option value="">Selecciona una opción...</option>
                                    <option value="Limpieza de parques">🌳 Limpieza de parques</option>
                                    <option value="Apoyo en comedor comunitario">🍽️ Apoyo en comedor comunitario</option>
                                    <option value="Mantenimiento de vías">🛠️ Mantenimiento de vías</option>
                                    <option value="Cuidado de adultos mayores">👴 Cuidado de adultos mayores</option>
                                    <option value="Apoyo educativo">📚 Apoyo educativo</option>
                                    <option value="Otro">✋ Otro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-modal">Horas de compromiso</label>
                                <input type="number" name="hours_committed"
                                    class="form-control-dark" min="1" max="100" required
                                    placeholder="Ej: 10">
                            </div>
                            <div>
                                <label class="form-label-modal">Detalles adicionales (Opcional)</label>
                                <textarea name="details" class="form-control-dark" rows="3"
                                    placeholder="Cuéntanos más sobre cómo puedes ayudar..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn-confirm">
                                <i class="bi bi-whatsapp me-1"></i> Confirmar y Contactar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endauth
        @empty
        <div class="col-12 text-center py-5" style="color:rgba(255,255,255,0.3);">
            <div style="font-size:60px; margin-bottom:16px;">🌿</div>
            <h4 style="color:rgba(255,255,255,0.4);">No hay productos disponibles</h4>
        </div>
        @endforelse
    </div>
</div>
@endsection
