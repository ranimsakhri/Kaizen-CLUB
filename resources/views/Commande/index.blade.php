@extends('layouts.app')

@section('title', 'Commandes - Kaizen Club')

@section('content')

<!-- ================= HERO ================= -->
<section class="reservations-hero position-relative">
    <div class="hero-overlay"></div>

    <div class="container text-center py-5 hero-content" data-aos="fade-up">
        <div class="logo-kaizen mb-4" data-aos="zoom-in">
            <svg viewBox="0 0 200 200" class="hero-svg">
                <path d="M100 20
                         C70 40, 50 80, 55 120
                         C60 155, 95 175, 100 180
                         C105 175, 140 155, 145 120
                         C150 80, 130 40, 100 20Z"/>
                <text x="100" y="125" text-anchor="middle" class="letter-k">K</text>
            </svg>
        </div>

        <h1 class="hero-title mb-2">Commandes</h1>
        <p class="hero-subtitle">
            {{ auth()->user()->role === 'admin' ? 'Gestion des commandes – Administrateur' : 'Mes commandes' }}
        </p>
    </div>
</section>

<!-- ================= TABLE ================= -->
<section class="reservations-table container my-5">
    <div class="content-wrapper">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-gold">
                    <i class="fas fa-shopping-cart me-2"></i>
                    {{ auth()->user()->role === 'admin' ? 'Toutes les commandes' : 'Mes commandes' }}
                </h2>
            </div>
            <!-- BOUTON DE RETOUR VERS LE MENU PRODUITS -->
<a href="{{ route('produit.index') }}"
   class="btn btn-outline-dashboard btn-lg">
    <i class="fas fa-arrow-left me-2"></i>Retour au menu
</a>



        </div>

        @if($commandes->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune commande disponible</h4>
            </div>
        @else
            <div class="table-responsive" data-aos="fade-up">
                <table class="table table-hover table-reservations">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Produits</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($commandes as $commande)
                            @php
                                $produits = is_string($commande->details)
                                    ? json_decode($commande->details, true)
                                    : $commande->details;
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ auth()->user()->role === 'admin' ? ($commande->user->name ?? 'Utilisateur inconnu') : '' }}
                                    @if(auth()->user()->role === 'user')
                                        Vous
                                    @endif
                                </td>

                                <td>
                                    <ul class="mb-0 ps-3">
                                        @foreach($produits as $p)
                                            <li>{{ $p['nom'] }} × {{ $p['quantite'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="fw-bold text-gold">
                                    {{ number_format($commande->total, 2) }} DT
                                </td>

                                <td>
                                    @php
                                        $color = match(strtolower($commande->statut)) {
                                            'confirmée' => 'success',
                                            'en attente' => 'warning',
                                            'livrée' => 'info',
                                            'annulée' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $color }}">
                                        {{ ucfirst($commande->statut) }}
                                    </span>
                                </td>

                                <td class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('commandes.show', $commande->id) }}"
                                       class="btn btn-gold btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('commandes.destroy', $commande->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Supprimer cette commande ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-dashboard btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @endif
    </div>
</section>
@endsection

@section('styles')
<style>
/* ================= HERO ================= */
.reservations-hero {
    position: relative;
    min-height: 40vh;
    background: linear-gradient(135deg, #fef9e0, #fff7e6, #f8fafc);
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.05);
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-svg {
    width: 100px;
    height: 100px;
    fill: none;
    stroke: #d4af37;
    stroke-width: 4;
    animation: draw 3s ease forwards;
}

@keyframes draw {
    from { stroke-dasharray: 600; stroke-dashoffset: 600; }
    to { stroke-dashoffset: 0; }
}

.letter-k {
    fill: #d4af37;
    font-size: 48px;
    font-weight: 800;
}

.hero-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #d4af37;
}

.hero-subtitle {
    color: #d4af37;
    letter-spacing: 1.5px;
}

/* ================= TABLE ================= */
.table-reservations {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.table-reservations thead {
    background: #111827;
    color: #d4af37;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.table-reservations tbody tr:hover {
    background: rgba(212,175,55,0.08);
}

/* ================= BUTTONS ================= */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #111827;
    border-radius: 30px;
    font-weight: 600;
    padding: 6px 16px;
}

.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(212,175,55,0.4);
}

.btn-outline-dashboard {
    color: #111827;
    border: 1px solid #d4af37;
    border-radius: 30px;
    padding: 6px 16px;
}

.btn-outline-dashboard:hover {
    background: rgba(212,175,55,0.1);
}

/* RESPONSIVE */
@media(max-width:768px){
    .table-reservations th,
    .table-reservations td {
        font-size: 0.85rem;
    }
    .hero-title {
        font-size: 1.8rem;
    }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
