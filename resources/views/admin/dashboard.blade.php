@extends('layouts.app')

@section('title', 'Dashboard Admin - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Titre -->
        <div class="mb-4">
            <h2 class="fw-bold">
                <i class="fas fa-user-shield me-2"></i>Dashboard Admin
            </h2>
            <p class="text-muted mb-0">Gestion complète du club Kaizen</p>
        </div>

        <!-- Menu de navigation -->
        <div class="row g-4 mt-4">

            <!-- Activités sportives -->
            <div class="col-md-4">
                <a href="{{ route('activiteSportif.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-dumbbell fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Activités Sportives</h5>
                        <p class="card-text text-center">Ajouter, modifier ou supprimer des activités.</p>
                    </div>
                </a>
            </div>

            <!-- Horaires -->
            <div class="col-md-4">
                <a href="{{ route('horaire.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-clock fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Horaires</h5>
                        <p class="card-text text-center">Gérer les horaires des activités et réservations.</p>
                    </div>
                </a>
            </div>

            <!-- Produits / Café -->
            <div class="col-md-4">
                <a href="{{ route('produit.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-coffee fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Produits / Café</h5>
                        <p class="card-text text-center">Modifier le menu et les prix.</p>
                    </div>
                </a>
            </div>

            <!-- Réservations -->
            <div class="col-md-4">
                <a href="{{ route('Reservation.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-calendar-check fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Réservations</h5>
                        <p class="card-text text-center">Voir, valider ou supprimer les réservations des membres.</p>
                    </div>
                </a>
            </div>

            <!-- Utilisateurs -->
            <div class="col-md-4">
                <a href="{{ route('users.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Utilisateurs</h5>
                        <p class="card-text text-center">Gérer les comptes des utilisateurs.</p>
                    </div>
                </a>
            </div>

            <!-- Commandes -->
            <div class="col-md-4">
                <a href="{{ route('commandes.index') }}" class="card text-decoration-none text-dark h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Commandes</h5>
                        <p class="card-text text-center">Suivi et gestion des commandes du café.</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
