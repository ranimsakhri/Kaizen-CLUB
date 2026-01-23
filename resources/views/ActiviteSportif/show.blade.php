@extends('layouts.app')

@section('title', $activiteSportif->nom . ' - Kaizen Club')

@section('content')

<section class="activities-hero">
    <div class="container py-5">

        <!-- Header avec retour -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-right">
                    <i class="fas fa-dumbbell me-2"></i>{{ $activiteSportif->nom }}
                </h2>
                <p class="activities-subtitle" data-aos="fade-left">
                    {{ $activiteSportif->type }} • {{ $activiteSportif->duree }} min • {{ number_format($activiteSportif->prix, 2) }} DT
                </p>
            </div>

            <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-gold" data-aos="fade-left">
                <i class="fas fa-arrow-left me-2"></i>Retour aux activités
            </a>
        </div>

        <!-- Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Contenu principal -->
        <div class="row g-4" data-aos="fade-up">

            <!-- Carte principale d'activité -->
            <div class="col-lg-8">
                <div class="card-dashboard h-100 text-center">
                    <div class="card-body py-5">
                        <div class="dynamic-icon mb-4 mx-auto">
                            @switch($activiteSportif->type)
                                @case('Équitation') <i class="fas fa-horse"></i> @break
                                @case('Natation') <i class="fas fa-swimmer"></i> @break
                                @case('Danse') <i class="fas fa-music"></i> @break
                                @case('Fitness') <i class="fas fa-dumbbell"></i> @break
                                @case('Yoga') <i class="fas fa-spa"></i> @break
                                @case('Musculation') <i class="fas fa-dumbbell"></i> @break
                                @case('Boxe') <i class="fas fa-hand-rock"></i> @break
                                @default <i class="fas fa-running"></i>
                            @endswitch
                        </div>

                        <h3 class="mb-3 activity-detail-title">{{ $activiteSportif->nom }}</h3>

                        <div class="d-flex justify-content-center gap-5 mb-4 flex-wrap">
                            <div class="info-item">
                                <i class="fas fa-clock me-2 text-gold"></i>
                                <strong>{{ $activiteSportif->duree }} min</strong>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-users me-2 text-gold"></i>
                                <strong>{{ $activiteSportif->capacite }} pers.</strong>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-tag me-2 text-gold"></i>
                                <strong class="text-success">{{ number_format($activiteSportif->prix, 2) }} DT</strong>
                            </div>
                        </div>

                        @php
                            $placesPrises = $activiteSportif->reservations()->count();
                            $estComplet = $placesPrises >= $activiteSportif->capacite;
                        @endphp

                        @if($estComplet)
                            <div class="mt-5">
                                <div class="alert alert-danger d-inline-block px-5 py-3">
                                    <i class="fas fa-ban me-2"></i>
                                    Activité complète ! ({{ $placesPrises }} / {{ $activiteSportif->capacite }} réservations)
                                </div>
                            </div>
                        @else
                            @auth
                                @if(auth()->user()->role === 'user')
                                    <a href="{{ route('Reservation.create', $activiteSportif->id) }}" class="btn btn-gold btn-lg mt-4">
                                        <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                                    </a>
                                @endif

                                @if(auth()->user()->role === 'admin')
                                    <div class="mt-4 d-flex gap-3 justify-content-center flex-wrap">
                                        <a href="{{ route('activiteSportif.edit', $activiteSportif->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i>Modifier
                                        </a>
                                        <form action="{{ route('activiteSportif.destroy', $activiteSportif->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette activité ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">
                                                <i class="fas fa-trash me-2"></i>Supprimer
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar infos supplémentaires -->
            <div class="col-lg-4">
                <div class="card-dashboard h-100">
                    <div class="card-body">
                        <h5 class="mb-4 activity-detail-title">Informations</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fas fa-tag text-gold me-2"></i>
                                <strong>Type :</strong> {{ $activiteSportif->type }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-clock text-gold me-2"></i>
                                <strong>Durée :</strong> {{ $activiteSportif->duree }} minutes
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-users text-gold me-2"></i>
                                <strong>Capacité :</strong> {{ $activiteSportif->capacite }} personnes
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-users text-gold me-2"></i>
                                <strong>Réservées :</strong> {{ $placesPrises }}
                            </li>
                            <li>
                                <i class="fas fa-money-bill-wave text-gold me-2"></i>
                                <strong>Prix :</strong> <span class="text-success fw-bold">{{ number_format($activiteSportif->prix, 2) }} DT</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

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
h1, h2, h3, h4, h5 {
    color: #111827 !important;
    font-weight: 800;
}

.activities-subtitle,
.activities-hero p,
.card-dashboard p,
.info-item,
.alert {
    color: #374151;
}

/* ================== BOUTON OR ================== */
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
    margin: 0 auto 25px;
    transition: all 0.45s ease;
}
.dynamic-icon:hover {
    transform: scale(1.15) rotate(8deg);
    box-shadow: 0 20px 50px rgba(212,175,55,0.4);
}

.info-item {
    font-size: 1.1rem;
}

.info-item strong {
    color: #111827;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 992px) {
    .activities-title { font-size: 2.4rem; }
}

@media (max-width: 768px) {
    .activities-title { font-size: 2rem; }
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
