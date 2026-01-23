@extends('layouts.app')

@section('title', 'Détails de la Réservation - Kaizen Club')

@section('content')

<section class="activities-hero">
    <div class="container py-5">

        @auth
            @if(auth()->user()->role === 'admin')
                <!-- ================= ADMIN VIEW ================= -->
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="activities-title">
                        <i class="fas fa-receipt me-2"></i>Détails de la Réservation
                    </h2>
                    <p class="activities-subtitle mt-2">
                        Réservation de l'utilisateur "<strong>{{ $reservation->user->name ?? 'N/A' }}</strong>"
                    </p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <div class="card-dashboard shadow-lg" data-aos="fade-up">
                            <div class="card-body p-5 text-center">

                                @php
                                    $color = match($reservation->statut) {
                                        'en attente' => 'warning',
                                        'confirmée' => 'success',
                                        'annulée' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp

                                <div class="dynamic-icon mb-5 mx-auto">
                                    <i class="fas fa-dumbbell"></i>
                                </div>

                                <h3 class="mb-4 activity-detail-title">{{ $reservation->activiteSportif->nom ?? 'N/A' }}</h3>

                                <div class="row g-4 mb-5">
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-tag text-gold mb-2"></i>
                                            <strong>Type</strong><br>
                                            {{ $reservation->activiteSportif->type ?? '' }}
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-clock text-gold mb-2"></i>
                                            <strong>Durée</strong><br>
                                            {{ $reservation->activiteSportif->duree ?? '' }} min
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-money-bill-wave text-gold mb-2"></i>
                                            <strong>Prix</strong><br>
                                            <span class="text-success fw-bold">
                                                {{ number_format($reservation->activiteSportif->prix ?? 0, 2) }} DT
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-users text-gold mb-2"></i>
                                            <strong>Capacité</strong><br>
                                            {{ $reservation->activiteSportif->capacite ?? '' }} pers.
                                        </div>
                                    </div>
                                </div>

                                <p class="mb-4">
                                    <strong>Statut :</strong>
                                    <span class="badge bg-{{ $color }} fs-6 px-4 py-2">
                                        {{ ucfirst($reservation->statut) }}
                                    </span>
                                </p>

                                <div class="d-flex gap-3 justify-content-center flex-wrap mt-5">
                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-gold">
                                        <i class="fas fa-edit me-2"></i>Modifier
                                    </a>
                                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette réservation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-gold">
                                            <i class="fas fa-trash me-2"></i>Supprimer
                                        </button>
                                    </form>
                                    <a href="{{ route('Reservation.index') }}" class="btn btn-outline-gold">
                                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @elseif(auth()->user()->role === 'user')
                <!-- ================= USER VIEW ================= -->
                <div class="text-center mb-5" data-aos="fade-down">
                    <h2 class="activities-title">
                        <i class="fas fa-receipt me-2"></i>Ma Réservation
                    </h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <div class="card-dashboard shadow-lg" data-aos="fade-up">
                            <div class="card-body p-5 text-center">

                                @php
                                    $color = match($reservation->statut) {
                                        'en attente' => 'warning',
                                        'confirmée' => 'success',
                                        'annulée' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp

                                <div class="dynamic-icon mb-5 mx-auto">
                                    <i class="fas fa-dumbbell"></i>
                                </div>

                                <h3 class="mb-4 activity-detail-title">{{ $reservation->activiteSportif->nom ?? 'N/A' }}</h3>

                                <div class="row g-4 mb-5">
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-tag text-gold mb-2"></i>
                                            <strong>Type</strong><br>
                                            {{ $reservation->activiteSportif->type ?? '' }}
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-clock text-gold mb-2"></i>
                                            <strong>Durée</strong><br>
                                            {{ $reservation->activiteSportif->duree ?? '' }} min
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-money-bill-wave text-gold mb-2"></i>
                                            <strong>Prix</strong><br>
                                            <span class="text-success fw-bold">
                                                {{ number_format($reservation->activiteSportif->prix ?? 0, 2) }} DT
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="info-item">
                                            <i class="fas fa-users text-gold mb-2"></i>
                                            <strong>Capacité</strong><br>
                                            {{ $reservation->activiteSportif->capacite ?? '' }} pers.
                                        </div>
                                    </div>
                                </div>

                                <p class="mb-5">
                                    <strong>Statut :</strong>
                                    <span class="badge bg-{{ $color }} fs-6 px-4 py-2">
                                        {{ ucfirst($reservation->statut) }}
                                    </span>
                                </p>

                                <a href="{{ route('Reservation.index') }}" class="btn btn-outline-gold">
                                    <i class="fas fa-arrow-left me-2"></i>Retour à mes réservations
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        @endauth

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

/* ================== TITRES – TOUS EN NOIR ================== */
.activities-title,
.activity-detail-title,
h1, h2, h3, h5 {
    color: #111827 !important;          /* noir foncé pour tous les titres */
    font-weight: 800;
}

.activities-subtitle,
.activities-hero p,
.card-dashboard p,
.info-item {
    color: #374151;                     /* gris foncé pour les sous-titres et infos */
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

/* ================== CARTES ================== */
.card-dashboard {
    background: white;
    border-radius: 20px;
    padding: 30px;
    color: #1e293b;
    transition: all 0.4s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    height: 100%;
    text-align: center;
}
.card-dashboard:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 50px rgba(212,175,55,0.3);
}

.dynamic-icon {
    font-size: 5rem;
    width: 140px;
    height: 140px;
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111827;
    margin: 0 auto 30px;
    transition: all 0.45s ease;
}
.dynamic-icon:hover {
    transform: scale(1.15) rotate(8deg);
    box-shadow: 0 20px 50px rgba(212,175,55,0.4);
}

/* ================== RESPONSIVE ================== */
@media (max-width: 768px) {
    .activities-title { font-size: 2.2rem; }
    .dynamic-icon { font-size: 4rem; width: 110px; height: 110px; }
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
