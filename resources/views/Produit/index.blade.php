@extends('layouts.app')

@section('title', 'Produits - Kaizen Club')

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-down">
                    <i class="fas fa-coffee me-2"></i> Menu Café
                </h2>
                <p class="activities-subtitle" data-aos="fade-up">Découvrez nos produits disponibles</p>
            </div>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('produit.create') }}" class="btn btn-gold btn-lg" data-aos="zoom-in">
                    <i class="fas fa-plus me-2"></i> Ajouter un produit
                </a>
            @endif
        </div>

        <!-- Message succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Recherche -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control input-dashboard" placeholder="Rechercher un produit...">
            </div>
        </div>

        <!-- Menu par catégories -->
        @foreach($categories as $categorie)
            @if($categorie->produits->isNotEmpty())
                <h3 class="fw-bold mt-4 mb-3 activities-subtitle text-dark" data-aos="fade-right">
                    {!! $categorie->icone !!} {{ $categorie->nom }}
                </h3>

                <div class="row g-4 mb-4" id="produitsCards">
                    @foreach($categorie->produits as $produit)
                        <div class="col-md-6 col-lg-4 produit-card" data-nom="{{ strtolower($produit->nom) }}" data-aos="fade-up">
                            <div class="card card-activity h-100 text-center p-4">

                                <div class="card-icon mb-3">
                                    <i class="fas fa-coffee text-gold"></i>
                                </div>

                                <h5 class="fw-bold text-gold">{{ $produit->nom }}</h5>
                                <h4 class="text-success fw-bold">{{ number_format($produit->prix, 2) }} DT</h4>

                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <a href="{{ route('produit.show', $produit->id) }}"
                                       class="btn btn-outline-dashboard btn-sm text-dark">
                                        <i class="fas fa-eye me-1"></i> Détails
                                    </a>

                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('produit.edit', $produit->id) }}"
                                           class="btn btn-outline-warning btn-sm text-dark">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('produit.destroy', $produit->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm text-dark">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

    </div>
</section>
@endsection

@section('styles')
<style>
/* ================== HERO & FOND ================== */
.activities-hero {
    min-height: 100vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
}

@keyframes gradientBG {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

/* TITRES */
.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}

.activities-subtitle {
    font-size: 1.05rem;
    color: #111827 !important;
    margin-top: 6px;
    font-weight: 500;
}

/* INPUT RECHERCHE */
.input-dashboard {
    border-radius: 12px;
    padding: 12px 15px;
    border: 1.5px solid #d1d5db;
    background: #ffffff;
    color: #111827 !important;
    font-weight: 500;
}

.input-dashboard::placeholder {
    color: #111827 !important;
    opacity: 0.7;
}

.input-dashboard:focus {
    border-color: #d4af37;
    box-shadow: 0 0 0 0.18rem rgba(212,175,55,0.25);
}

/* BOUTONS */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #111827 !important;
    border: none;
    border-radius: 30px;
    padding: 12px 28px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.4);
}

.btn-outline-dashboard,
.btn-outline-warning,
.btn-outline-danger {
    color: #111827 !important;
    font-weight: 500;
}

.btn-outline-dashboard:hover {
    background: rgba(212,175,55,0.1);
}

/* ALERTES */
.alert-danger,
.alert-success {
    border-radius: 14px;
    font-weight: 500;
    color: #111827 !important;
}

/* CARDS PRODUITS */
.card-activity {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.card-activity:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(212,175,55,0.25);
}

/* TITRES DES PRODUITS EN DORÉ */
.card-activity h5 {
    color: #d4af37 !important;
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .activities-title {
        font-size: 2rem;
    }
    .activities-subtitle {
        font-size: 0.95rem;
    }
    .card-activity h5 {
        font-size: 1.1rem;
    }
}

/* Forcer tous les autres textes en noir par défaut */
.text-muted, .text-secondary, p, span, small, label, h4, h3, h2, .btn-sm {
    color: #111827 !important;
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });

    // Recherche produits
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll('.produit-card').forEach(card => {
            card.style.display = card.dataset.nom.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
