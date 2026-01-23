@extends('layouts.app')

@section('title', $user->name . ' - Kaizen Club')

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- TITRE HERO -->
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="activities-title fw-bold">
                <i class="fas fa-user me-2"></i>{{ $user->name }}
            </h1>
            <p class="activities-subtitle">Détails de votre profil</p>
        </div>

        <!-- CARTE PROFIL -->
        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-md-8">
                <div class="card-dashboard p-4 text-center">

                    <!-- Icône utilisateur -->
                    <div class="mb-4">
                        <i class="fas fa-user-circle fa-5x text-gold"></i>
                    </div>

                    <!-- Rôle -->
                    <span class="badge rounded-pill mb-4"
                          style="background: {{ $user->role == 'admin' ? '#d4af37' : '#3b82f6' }}; color: #fff; padding:0.5rem 1.2rem; font-size:1rem;">
                        {{ ucfirst($user->role) }}
                    </span>

                    <!-- Email -->
                    <p class="text-dark mb-1 fw-medium"><i class="fas fa-envelope me-2 text-gold"></i>Email</p>
                    <h5 class="fw-bold mb-4 text-dark">{{ $user->email }}</h5>

                    <!-- Informations complémentaires -->
                    <div class="row g-3 mt-4 text-dark">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3">
                                <i class="fas fa-user-clock fa-2x text-gold mb-2"></i>
                                <div>
                                    <small class="d-block fw-medium">Créé le</small>
                                    <strong>{{ $user->created_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3">
                                <i class="fas fa-calendar-check fa-2x text-gold mb-2"></i>
                                <div>
                                    <small class="d-block fw-medium">Dernière mise à jour</small>
                                    <strong>{{ $user->updated_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-center gap-4 mt-5 flex-wrap">
                        <a href="{{ route('Reservation.index') }}" class="btn btn-gold btn-lg px-5">
                            <i class="fas fa-calendar-check me-2"></i>Mes Réservations
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-gold btn-lg px-5">
                            <i class="fas fa-edit me-2"></i>Modifier Profil
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('styles')
<style>
/* ================= HERO & FOND ================== */
.activities-hero {
    min-height: 80vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

@keyframes gradientBG {
    0% { background-position:0% 50%; }
    50% { background-position:100% 50%; }
    100% { background-position:0% 50%; }
}

/* TITRES */
.activities-title {
    font-size: 2.6rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}
.activities-subtitle {
    font-size: 1rem;
    color: #6b7280;          /* gris moyen au lieu de très clair */
    margin-top: 8px;
}

/* CARTE DASHBOARD */
.card-dashboard {
    background: #fff;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.10);
    transition: all .4s ease;
}
.card-dashboard:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(212,175,55,0.30);
}

/* BADGES */
.badge {
    padding: 0.5rem 1.2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
}

/* BORDURES */
.card-dashboard .border {
    border-color: #e5e7eb !important;
}

/* BOUTONS – version harmonisée gold */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #e9c46a);
    color: #1f2937;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    padding: 14px 32px;
    transition: all 0.35s ease;
    box-shadow: 0 4px 14px rgba(212,175,55,0.25);
}
.btn-gold:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(212,175,55,0.45);
    background: linear-gradient(135deg, #e9c46a, #f5d76e);
}

.btn-outline-gold {
    color: #d4af37;
    border: 2px solid #d4af37;
    background: transparent;
    border-radius: 50px;
    font-weight: 600;
    padding: 12px 30px;
    transition: all 0.35s ease;
}
.btn-outline-gold:hover {
    background: #d4af37;
    color: #1f2937;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.3);
}

/* ICONES GOLD */
.text-gold { color: #d4af37 !important; }

/* Tous les textes importants en sombre */
.text-dark, h5, strong, .fw-bold, small.fw-medium {
    color: #111827 !important;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .activities-title { font-size: 2.1rem; }
    .card-dashboard { padding: 25px; }
}
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
