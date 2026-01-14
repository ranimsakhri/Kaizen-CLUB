@extends('layouts.app')

@section('title', 'Kaizen Club - Bienvenue')

@section('content')
<!-- Hero Section -->
<div class="hero-section py-5 text-center" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
    <div class="container">
        <h1 class="animate__animated animate__fadeInDown">Bienvenue au Kaizen Club</h1>
        <p class="animate__animated animate__fadeInUp animate__delay-1s">Votre destination pour l'excellence sportive et le bien-être</p>
        <a href="{{ route('activiteSportif.index') }}" class="btn btn-light btn-lg mt-3 animate__animated animate__zoomIn animate__delay-2s">Découvrir nos activités</a>
    </div>
</div>

<!-- Activités Section -->
<div class="container mb-5">
    <div class="row g-4">

        <!-- Activités Sportives -->
        <div class="col-md-6 col-lg-4">
            <div class="card-activity h-100 shadow-sm border-0 hover-animate">
                <div class="card-icon">
                    <i class="fas fa-running fa-2x"></i>
                </div>
                <div class="card-body text-center">
                    <h5>Activités Sportives</h5>
                    <p>Découvrez notre large gamme d'activités : équitation, natation, danse, fitness et plus encore.</p>
                    <a href="{{ route('activiteSportif.index') }}" class="btn btn-primary-custom btn-custom">Explorer</a>
                </div>
            </div>
        </div>

        <!-- Horaires -->
        <div class="col-md-6 col-lg-4">
            <div class="card-activity h-100 shadow-sm border-0 hover-animate">
                <div class="card-icon">
                    <i class="fas fa-clock fa-2x"></i>
                </div>
                <div class="card-body text-center">
                    <h5>Horaires</h5>
                    <p>Consultez les horaires de toutes nos activités et planifiez votre semaine sportive.</p>
                    <a href="{{ route('horaire.index') }}" class="btn btn-primary-custom btn-custom">Voir Horaires</a>
                </div>
            </div>
        </div>

        <!-- Café -->
        <div class="col-md-6 col-lg-4">
            <div class="card-activity h-100 shadow-sm border-0 hover-animate">
                <div class="card-icon">
                    <i class="fas fa-coffee fa-2x"></i>
                </div>
                <div class="card-body text-center">
                    <h5>Café Intégré</h5>
                    <p>Détendez-vous dans notre café avec des boissons saines et des en-cas nutritifs.</p>
                    <a href="{{ route('produit.index') }}" class="btn btn-primary-custom btn-custom">Notre Menu</a>
                </div>
            </div>
        </div>

        <!-- Réservations -->
        <div class="col-md-6 col-lg-4">
            <div class="card-activity h-100 shadow-sm border-0 hover-animate">
                <div class="card-icon">
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
                <div class="card-body text-center">
                    <h5>Réservations</h5>
                    <p>Réservez votre place pour vos activités préférées en quelques clics.</p>
                    <a href="{{ route('Reservation.index') }}" class="btn btn-primary-custom btn-custom">Réserver</a>
                </div>
            </div>
        </div>

        <!-- Commandes -->
        <div class="col-md-6 col-lg-4">
            <div class="card-activity h-100 shadow-sm border-0 hover-animate">
                <div class="card-icon">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                </div>
                <div class="card-body text-center">
                    <h5>Commandes Café</h5>
                    <p>Passez vos commandes au café et profitez de nos produits de qualité.</p>
                    <a href="{{ route('commandes.index') }}" class="btn btn-primary-custom btn-custom">Commander</a>
                </div>
            </div>
        </div>

        <!-- Gestion Membres -->
        <div class="col-md-6 col-lg-4">
            <div class="card-activity h-100 shadow-sm border-0 hover-animate">
                <div class="card-icon">
                    <i class="fas fa-users-cog fa-2x"></i>
                </div>
                <div class="card-body text-center">
                    <h5>Gestion Membres</h5>
                    <p>Administrez les membres et leurs accès au club.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-primary-custom btn-custom">Gérer</a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Section Pourquoi Kaizen -->
<div class="container mb-5">
    <div class="content-wrapper">
        <div class="text-center mb-5">
            <h2 class="fw-bold animate__animated animate__fadeInDown">Pourquoi choisir Kaizen Club ?</h2>
            <p class="text-muted animate__animated animate__fadeInUp animate__delay-1s">L'amélioration continue au cœur de notre philosophie</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 text-center animate__animated animate__fadeInLeft">
                <div class="mb-3">
                    <i class="fas fa-trophy fa-3x"></i>
                </div>
                <h5 class="fw-bold">Équipements Professionnels</h5>
                <p class="text-muted">Des installations modernes et un équipement de qualité professionnelle</p>
            </div>

            <div class="col-md-4 text-center animate__animated animate__fadeInUp animate__delay-1s">
                <div class="mb-3">
                    <i class="fas fa-user-friends fa-3x"></i>
                </div>
                <h5 class="fw-bold">Coachs Certifiés</h5>
                <p class="text-muted">Une équipe de professionnels passionnés pour vous accompagner</p>
            </div>

            <div class="col-md-4 text-center animate__animated animate__fadeInRight animate__delay-2s">
                <div class="mb-3">
                    <i class="fas fa-heart fa-3x"></i>
                </div>
                <h5 class="fw-bold">Communauté Bienveillante</h5>
                <p class="text-muted">Rejoignez une communauté motivante et solidaire</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.card-activity {
    border-radius: 15px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.hover-animate:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
