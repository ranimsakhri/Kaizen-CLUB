@extends('layouts.app')

@section('title', 'Activités Sportives - Kaizen Club')

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-right">
                    <i class="fas fa-dumbbell me-2"></i>Activités Sportives
                </h2>
                <p class="activities-subtitle" data-aos="fade-left">Consultez toutes les activités disponibles</p>
            </div>

            <!-- Bouton Ajouter : ADMIN SEULEMENT -->
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('activiteSportif.create') }}" class="btn btn-gold btn-lg" data-aos="zoom-in">
                        <i class="fas fa-plus me-2"></i>Ajouter une activité
                    </a>
                @endif
            @endauth
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

        <!-- ================== CARDS ACTIVITÉS ================== -->
        <div class="row g-4" data-aos="fade-up">
            @foreach($activites as $index => $activite)
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    @if($activite->reservations()->count() >= $activite->capacite)
                        <div class="card-dashboard h-100 position-relative disabled-card">
                            <i class="fas fa-dumbbell fa-2x mb-3"></i>
                            <h5>{{ $activite->nom }}</h5>
                            <p>Type : {{ $activite->type }}</p>
                            <p class="text-danger fw-bold">Complet</p>
                        </div>
                    @else
                        <a href="{{ route('activiteSportif.show', $activite->id) }}" class="card-dashboard h-100 position-relative">
                            <i class="fas fa-dumbbell fa-2x mb-3"></i>
                            <h5>{{ $activite->nom }}</h5>
                            <p>Type : {{ $activite->type }}</p>
                            <p>Durée : {{ $activite->duree }} min</p>
                            <p class="text-success fw-bold">Prix : {{ number_format($activite->prix, 2) }} DT</p>
                            <p>Capacité : {{ $activite->capacite }} pers.</p>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Tableau Admin -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="table-responsive mt-5" data-aos="fade-up">
                    <h4 class="mb-3">Vue Administrative</h4>
                    <table class="table table-hover table-admin">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Durée</th>
                                <th>Prix</th>
                                <th>Capacité</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activites as $activite)
                                <tr>
                                    <td>{{ $activite->nom }}</td>
                                    <td>{{ $activite->type }}</td>
                                    <td>{{ $activite->duree }} min</td>
                                    <td>{{ number_format($activite->prix, 2) }} DT</td>
                                    <td>{{ $activite->capacite }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('activiteSportif.edit', $activite->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('activiteSportif.destroy', $activite->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Supprimer cette activité ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

/* ================== TITRES – TOUS EN NOIR ================== */
.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;              /* noir foncé */
    letter-spacing: 0.5px;
}

.activities-subtitle {
    font-size: 1rem;
    color: #374151;              /* noir moyen au lieu de gris clair */
    margin-top: 6px;
}

.card-dashboard h5 {
    color: #111827;              /* titres des cartes en noir */
    font-weight: 700;
}

.table-admin h4 {
    color: #111827;              /* titre "Vue Administrative" en noir */
}

.table-admin thead th {
    color: #ffffff;              /* en-tête table reste blanc (sur fond noir) */
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

/* ================== CARTES ================== */
.card-dashboard {
    display: block;
    text-decoration: none;
    background: white;
    border-radius: 20px;
    padding: 30px 20px;
    color: #1e293b;
    transition: all 0.4s ease;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    height: 100%;
    position: relative;
    overflow: hidden;
}
.card-dashboard i { color: #d4af37; transition: all 0.4s ease; }
.card-dashboard p { font-size: 0.95rem; color: #475569; }
.card-dashboard::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, rgba(212,175,55,0.2) 0%, transparent 70%);
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
    box-shadow: 0 20px 50px rgba(212,175,55,0.4);
}
.card-dashboard:hover i {
    transform: rotate(15deg) scale(1.2);
    color: #d4af37;
}

/* ================== CARTE COMPLÈTE ================== */
.disabled-card {
    opacity: 0.6;
    pointer-events: none;
    background: #f5f5f5;
    color: #9ca3af;
}

/* ================== TABLE ADMIN ================== */
.table-admin {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.table-admin thead {
    background: #111827;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 0.85rem;
}
.table-admin tbody tr:hover {
    background: rgba(212,175,55,0.08);
}
.table-admin td, .table-admin th {
    color: #111827; /* texte du corps en noir */
}

/* ================== BOUTONS ADMIN ================== */
.btn-warning { background-color: #fbbf24; border: none; color: #1e293b; }
.btn-danger { background-color: #ef4444; border: none; color: #fff; }x
.btn-warning:hover { background-color: #f59e0b; }
.btn-danger:hover { background-color: #dc2626; }

/* RESPONSIVE */
@media (max-width: 768px) {
    .activities-title { font-size: 2rem; }
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
