@extends('layouts.app')

@section('title', $activiteSportif->nom . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('activiteSportif.index') }}">Activités</a></li>
                <li class="breadcrumb-item active">{{ $activiteSportif->nom }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Icône et Image -->
            <div class="col-lg-5">
                <div class="text-center">
                    <div class="card-icon mx-auto mb-4" style="width: 120px; height: 120px; font-size: 3rem;">
                        @switch($activiteSportif->type)
                            @case('Équitation')
                                <i class="fas fa-horse"></i>
                                @break
                            @case('Natation')
                                <i class="fas fa-swimmer"></i>
                                @break
                            @case('Danse')
                                <i class="fas fa-music"></i>
                                @break
                            @case('Fitness')
                                <i class="fas fa-dumbbell"></i>
                                @break
                            @case('Yoga')
                                <i class="fas fa-spa"></i>
                                @break
                            @case('Musculation')
                                <i class="fas fa-dumbbell"></i>
                                @break
                            @case('Boxe')
                                <i class="fas fa-hand-rock"></i>
                                @break
                            @default
                                <i class="fas fa-running"></i>
                        @endswitch
                    </div>
                </div>
            </div>

            <!-- Détails -->
            <div class="col-lg-7">
                <div class="mb-3">
                    <span class="badge badge-custom px-4 py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-size: 0.9rem;">
                        {{ $activiteSportif->type }}
                    </span>
                </div>

                <h1 class="fw-bold mb-3" style="color: var(--primary);">{{ $activiteSportif->nom }}</h1>

                <!-- Prix -->
                <div class="mb-4">
                    <h2 class="fw-bold text-success mb-0">{{ number_format($activiteSportif->prix, 2) }} DT</h2>
                    <small class="text-muted">par séance</small>
                </div>

                <!-- Informations détaillées -->
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3 border rounded-3 h-100">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-clock fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Durée</small>
                                    <strong>{{ $activiteSportif->duree }} minutes</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border rounded-3 h-100">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-users fa-2x text-success"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Capacité</small>
                                    <strong>{{ $activiteSportif->capacite }} personnes</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="d-flex gap-3 flex-wrap">
                    <!-- Tous les utilisateurs peuvent réserver -->
                    <a href="{{ route('Reservation.create', $activiteSportif->id) }}" class="btn btn-success btn-custom">
                        <i class="fas fa-calendar-plus me-2"></i>Réserver cette activité
                    </a>

                    <!-- Seuls les admins peuvent modifier ou supprimer -->
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('activiteSportif.edit', $activiteSportif->id) }}" class="btn btn-warning btn-custom">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>

                            <form action="{{ route('activiteSportif.destroy', $activiteSportif->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-custom">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </form>
                        @endif
                    @endauth

                    <!-- Retour -->
                    <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-secondary btn-custom">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Section avantages (toujours visible) -->
        <div class="row g-4 mt-5">
            <div class="col-12">
                <h4 class="fw-bold mb-4 text-center" style="color: var(--primary);">
                    <i class="fas fa-star me-2"></i>Pourquoi choisir cette activité ?
                </h4>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3"><i class="fas fa-medal fa-3x" style="color: var(--secondary);"></i></div>
                <h6 class="fw-bold">Encadrement Pro</h6>
                <p class="text-muted small">Coachs certifiés et expérimentés</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3"><i class="fas fa-tools fa-3x" style="color: var(--primary);"></i></div>
                <h6 class="fw-bold">Équipements Modernes</h6>
                <p class="text-muted small">Matériel de qualité professionnelle</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3"><i class="fas fa-chart-line fa-3x" style="color: var(--success);"></i></div>
                <h6 class="fw-bold">Progrès Garantis</h6>
                <p class="text-muted small">Suivi personnalisé de votre évolution</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3"><i class="fas fa-calendar-check fa-3x" style="color: var(--danger);"></i></div>
                <h6 class="fw-bold">Horaires Flexibles</h6>
                <p class="text-muted small">Plusieurs créneaux disponibles</p>
            </div>
        </div>
    </div>
</div>
@endsection
