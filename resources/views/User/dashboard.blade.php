@extends('layouts.app')

@section('title','Dashboard Utilisateur - Kaizen Club')

@section('content')

<!-- ================= HERO DASHBOARD ================= -->
<section class="hero-dashboard">

    <div class="hero-overlay"></div>

    <div class="hero-content container py-5">

        <!-- TITRE -->
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="hero-title fw-bold">
                <i class="fas fa-user me-2"></i>Dashboard Utilisateur
            </h1>
            <p class="hero-subtitle">Bienvenue dans votre espace personnel Kaizen Club</p>
        </div>

        <!-- MENU UTILISATEUR -->
        <div class="row g-4">

            <!-- Mes Réservations -->
            <div class="col-md-6" data-aos="fade-up">
                <a href="{{ route('Reservation.index') }}" class="card card-glass text-decoration-none text-light h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-calendar-check fa-3x mb-3 text-gold"></i>
                        <h5 class="card-title">Mes Réservations</h5>
                        <p class="card-text text-center">Voir, modifier ou annuler vos réservations.</p>
                    </div>
                </a>
            </div>

            <!-- Activités disponibles -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('activiteSportif.index') }}" class="card card-glass text-decoration-none text-light h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-dumbbell fa-3x mb-3 text-gold"></i>
                        <h5 class="card-title">Activités</h5>
                        <p class="card-text text-center">Consulter les activités disponibles et leurs horaires.</p>
                    </div>
                </a>
            </div>

            <!-- Commandes utilisateur -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('commandes.index') }}" class="card card-glass text-decoration-none text-light h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart fa-3x mb-3 text-gold"></i>
                        <h5 class="card-title">Mes Commandes</h5>
                        <p class="card-text text-center">Consulter vos commandes passées et en cours.</p>
                    </div>
                </a>
            </div>

            <!-- Profil utilisateur -->
            @if(auth()->check())
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('users.show', auth()->id()) }}" class="card card-glass text-decoration-none text-light h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-user-circle fa-3x mb-3 text-gold"></i>
                        <h5 class="card-title">Mon Profil</h5>
                        <p class="card-text text-center">Voir et modifier vos informations personnelles.</p>
                    </div>
                </a>
            </div>
            @endif

            <!-- Menu Café / Produits -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('produit.index') }}" class="card card-glass text-decoration-none text-light h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-coffee fa-3x mb-3 text-gold"></i>
                        <h5 class="card-title">Menu Café</h5>
                        <p class="card-text text-center">Consulter les produits disponibles et leurs prix.</p>
                    </div>
                </a>
            </div>

            <!-- Horaires -->
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <a href="{{ route('horaire.index') }}" class="card card-glass text-decoration-none text-light h-100 shadow">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-clock fa-3x mb-3 text-gold"></i>
                        <h5 class="card-title">Horaires</h5>
                        <p class="card-text text-center">Consulter les horaires des activités et réservations.</p>
                    </div>
                </a>
            </div>

        </div>

    </div>
</section>

@endsection

{{-- ================= STYLES ================= --}}
@section('styles')
<style>
.hero-dashboard {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(135deg, #2b1d14, #5a3d8a, #2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    font-family: 'Poppins', sans-serif;
    padding-top: 60px;
    padding-bottom: 60px;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    color: #fff;
}

/* TITRE */
.hero-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.hero-subtitle {
    color: #d4af37;
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* GLASS CARDS */
.card-glass {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 30px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card-glass:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.5);
}

/* ICONES */
.text-gold {
    color: #d4af37;
}

/* CARD TEXT */
.card-title, .card-text {
    color: #fff;
}

.card-text {
    opacity: 0.85;
    font-size: 0.95rem;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.2rem;
    }
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

{{-- ================= SCRIPTS ================= --}}
@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
        once: true
    });
</script>
@endsection
