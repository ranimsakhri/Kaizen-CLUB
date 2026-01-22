@extends('layouts.app')

@section('title', $produit->nom . ' - Kaizen Club')

@section('content')

@auth
{{-- ============================ ADMIN VIEW ============================ --}}
@if(auth()->user()->role === 'admin')

<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-right">
                    <i class="fas fa-box me-2"></i> Détails du Produit
                </h2>
                <p class="activities-subtitle" data-aos="fade-left">
                    Gestion administrative du produit
                </p>
            </div>

            <a href="{{ route('produit.index') }}" class="btn btn-gold btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>

        <!-- Product Card -->
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="zoom-in">
                <div class="card-dashboard text-center">

                    <i class="fas fa-coffee fa-3x mb-3"></i>

                    <h5 class="fw-bold">{{ $produit->nom }}</h5>
                    <p>Catégorie : {{ $produit->categorie->nom ?? 'N/A' }}</p>
                    <p class="text-success fw-bold">
                        {{ number_format($produit->prix, 2) }} DT
                    </p>

                    <div class="d-flex justify-content-center gap-2 mt-4 flex-wrap">
                        <a href="{{ route('produit.edit', $produit->id) }}"
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>

                        <form action="{{ route('produit.destroy', $produit->id) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

@endif

{{-- ============================ USER VIEW ============================ --}}
@if(auth()->user()->role === 'user')

<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div class="text-center w-100 mb-4">
                <i class="fas fa-coffee fa-4x text-gold mb-3"></i>
                <h2 class="activities-title">{{ $produit->nom }}</h2>
                <p class="activities-subtitle">{{ $produit->categorie->nom ?? 'Produit du café' }}</p>
            </div>

            <a href="{{ route('produit.index') }}" class="btn btn-outline-gold btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>

        <!-- Product Card -->
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="zoom-in">
                <div class="card-dashboard text-center">

                    <p class="text-success fw-bold fs-3">
                        {{ number_format($produit->prix, 2) }} DT
                    </p>

                    <!-- Bouton Commander -->
                    <a href="{{ route('commande.create', $produit->id) }}" class="btn btn-gold mt-3">
                        <i class="fas fa-shopping-cart me-1"></i> Passer une commande
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endif
@endauth

@endsection

@section('styles')
<style>
/* ======================= GENERAL HERO ======================= */
.activities-hero {
    min-height: 80vh;
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

.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;
}

.activities-subtitle {
    color: #9ca3af;
}

/* ======================= CARD ======================= */
.card-dashboard {
    background: white;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 15px 40px rgba(0,0,0,.12);
    transition: all .4s ease;
}

.card-dashboard:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(212,175,55,.4);
}

.card-dashboard i {
    color: #d4af37;
}

/* ======================= BOUTONS ======================= */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #111827;
    border: none;
    border-radius: 30px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.4);
}

.btn-warning {
    background-color: #f5e1a4;
    color: #4b4b4b;
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-warning:hover {
    background-color: #edd588;
    box-shadow: 0 6px 15px rgba(212,175,55,0.3);
}

.btn-danger {
    background-color: #f8d7da;
    color: #842029;
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-danger:hover {
    background-color: #f5c2c7;
    box-shadow: 0 6px 15px rgba(220,53,69,0.3);
}

/* Bouton retour utilisateur */
.btn-outline-gold {
    border: 2px solid #d4af37;
    color: #d4af37;
    border-radius: 30px;
    padding: 8px 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-gold:hover {
    background: #d4af37;
    color: #111827;
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
