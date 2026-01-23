@extends('layouts.app')

@section('title', 'Commandes - Kaizen Club')

@section('content')

<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-right">
                    <i class="fas fa-shopping-cart me-2"></i>Commandes
                </h2>
                <p class="activities-subtitle" data-aos="fade-left">
                    {{ auth()->user()->role === 'admin' ? 'Gestion des commandes – Administrateur' : 'Mes commandes' }}
                </p>
            </div>

            <a href="{{ route('produit.index') }}" class="btn btn-outline-gold" data-aos="fade-left">
                <i class="fas fa-arrow-left me-2"></i>Retour au menu
            </a>
        </div>

        <!-- Messages (optionnel si tu as des flash messages) -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" data-aos="fade-down">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" data-aos="fade-down">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Contenu principal -->
        @if($commandes->isEmpty())
            <div class="text-center py-5" data-aos="fade-up">
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
                                    {{ auth()->user()->role === 'admin' ? ($commande->user->name ?? 'Utilisateur inconnu') : 'Vous' }}
                                </td>

                                <td>
                                    <ul class="mb-0 ps-3">
                                        @foreach($produits as $p)
                                            <li>{{ $p['nom'] ?? 'Produit inconnu' }} × {{ $p['quantite'] ?? 1 }}</li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="fw-bold text-success">
                                    {{ number_format($commande->total, 2) }} DT
                                </td>

                                <td>
                                    @php
                                        $color = match(strtolower($commande->statut ?? '')) {
                                            'confirmée' => 'success',
                                            'en attente' => 'warning',
                                            'livrée' => 'info',
                                            'annulée' => 'danger',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $color }}">
                                        {{ ucfirst($commande->statut ?? 'Inconnu') }}
                                    </span>
                                </td>

                                <td class="d-flex gap-2 flex-wrap">
                                    <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-gold btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if(auth()->user()->role === 'admin')
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette commande ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-gold btn-sm">
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
/* ================== HERO ================== */
.activities-hero {
    min-height: 100vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
}
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ================== TITRES ================== */
.activities-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}

.activities-subtitle {
    font-size: 1.1rem;
    color: #374151;
    margin-top: 6px;
}

/* ================== BOUTONS ================== */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #111827;
    border: none;
    border-radius: 30px;
    padding: 12px 28px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.4);
    color: #111827;
}

.btn-outline-gold {
    border: 2px solid #d4af37;
    color: #d4af37;
    background: transparent;
    border-radius: 30px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-outline-gold:hover {
    background: #d4af37;
    color: #111827;
}

/* ================== TABLE ================== */
.table-reservations {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.table-reservations thead {
    background: #111827;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 0.85rem;
}
.table-reservations tbody tr:hover {
    background: rgba(212,175,55,0.08);
}
.table-reservations td, .table-reservations th {
    color: #111827;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 768px) {
    .activities-title { font-size: 2.2rem; }
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
