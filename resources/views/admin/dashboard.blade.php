@extends('layouts.app')

@section('title', 'Dashboard Admin - Kaizen Club')

@section('content')
<section class="dashboard-hero">
    <div class="container py-5 text-center">
        <h1 class="dashboard-title mb-2" data-aos="fade-down">
            <i class="fas fa-user-shield me-2 text-gold"></i>Dashboard Admin
        </h1>
        <p class="dashboard-subtitle mb-5" data-aos="fade-up" data-aos-delay="200">
            Gestion complète du club Kaizen
        </p>

        <div class="row g-4">
            <!-- Cartes -->
            @php
            $cards = [
                ['route'=>'activiteSportif.index','icon'=>'dumbbell','title'=>'Activités Sportives','desc'=>'Ajouter, modifier ou supprimer des activités.'],
                ['route'=>'horaire.index','icon'=>'clock','title'=>'Horaires','desc'=>'Gérer les horaires des activités et réservations.'],
                ['route'=>'produit.index','icon'=>'coffee','title'=>'Produits / Café','desc'=>'Modifier le menu et les prix.'],
                ['route'=>'Reservation.index','icon'=>'calendar-check','title'=>'Réservations','desc'=>'Voir, valider ou supprimer les réservations des membres.'],
                ['route'=>'users.index','icon'=>'users','title'=>'Utilisateurs','desc'=>'Gérer les comptes des utilisateurs.'],
                ['route'=>'commandes.index','icon'=>'shopping-cart','title'=>'Commandes','desc'=>'Suivi et gestion des commandes du café.'],
            ];
            @endphp

            @foreach($cards as $index => $card)
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $index * 150 }}">
                <a href="{{ route($card['route']) }}" class="card-dashboard h-100">
                    <i class="fas fa-{{ $card['icon'] }} fa-3x mb-3 text-gold"></i>
                    <h5 class="card-title">{{ $card['title'] }}</h5>
                    <p class="card-desc">{{ $card['desc'] }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
/* ===== FOND GRADIENT ANIMÉ ===== */
.dashboard-hero {
    min-height: 100vh;
    padding-top: 50px;
    padding-bottom: 50px;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
}

@keyframes gradientBG {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

/* ===== TEXTES – TITRES EN NOIR ===== */
.dashboard-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #111827;
}

.dashboard-subtitle {
    color: #374151;
    font-size: 1.2rem;
    letter-spacing: 1px;
}

/* ===== CARTES DASHBOARD ===== */
.card-dashboard {
    display: block;
    text-decoration: none;
    background: white;
    border-radius: 20px;
    padding: 30px 20px;
    color: #1e293b;
    transition: all 0.4s ease;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    height: 100%;
    position: relative;
    overflow: hidden;
}

/* ICONES */
.card-dashboard i {
    color: #d4af37;
    transition: all 0.4s ease;
}

/* TITRE & DESCRIPTION DES CARTES */
.card-title {
    margin-top: 10px;
    margin-bottom: 10px;
    font-weight: 700;
    color: #111827;
}

.card-desc {
    font-size: 0.95rem;
    color: #475569;
}

/* HOVER EFFECT */
.card-dashboard::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, rgba(212,175,55,0.12) 0%, transparent 70%);
    transform: scale(0);
    transition: transform 0.5s ease;
    border-radius: 20px;
    pointer-events: none;
}

.card-dashboard:hover::before {
    transform: scale(2);
}

.card-dashboard:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.card-dashboard:hover i {
    transform: rotate(15deg) scale(1.2);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .dashboard-title {
        font-size: 2.2rem;
    }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration:1200, once:true });
</script>
@endsection
