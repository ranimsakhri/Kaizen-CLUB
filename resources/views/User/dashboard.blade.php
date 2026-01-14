@extends('layouts.app')

@section('title','Dashboard Utilisateur - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Titre -->
        <div class="mb-4">
            <h2 class="fw-bold">
                <i class="fas fa-user me-2"></i>Dashboard Utilisateur
            </h2>
            <p class="text-muted mb-0">Bienvenue dans votre espace personnel Kaizen Club</p>
        </div>

        <!-- Menu utilisateur -->
        <div class="row g-4 mt-4">

            <!-- Mes Réservations -->
            <div class="col-md-6">
                <a href="{{ route('Reservation.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-calendar-check fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Mes Réservations</h5>
                        <p class="card-text text-center">Voir, modifier ou annuler vos réservations.</p>
                    </div>
                </a>
            </div>

            <!-- Activités disponibles -->
            <div class="col-md-6">
                <a href="{{ route('activiteSportif.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-dumbbell fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Activités</h5>
                        <p class="card-text text-center">Consulter les activités disponibles et leurs horaires.</p>
                    </div>
                </a>
            </div>

            <!-- Commandes utilisateur -->
            <div class="col-md-6">
                <a href="{{ route('commandes.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Mes Commandes</h5>
                        <p class="card-text text-center">Consulter vos commandes passées et en cours.</p>
                    </div>
                </a>
            </div>

            <!-- Profil utilisateur -->
            <div class="col-md-6">
                @if(auth()->check())
                <a href="{{ route('users.show', auth()->id()) }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-user-circle fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Mon Profil</h5>
                        <p class="card-text text-center">Voir et modifier vos informations personnelles.</p>
                    </div>
                </a>
                @endif
            </div>

            <!-- Menu Café / Produits -->
            <div class="col-md-6">
                <a href="{{ route('produit.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-coffee fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Menu Café</h5>
                        <p class="card-text text-center">Consulter les produits disponibles et leurs prix.</p>
                    </div>
                </a>
            </div>

            <!-- Horaires -->
            <div class="col-md-6">
                <a href="{{ route('horaire.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-clock fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Horaires</h5>
                        <p class="card-text text-center">Consulter les horaires des activités et réservations.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
