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
                    <span class="badge rounded-pill mb-3"
                          style="background: {{ $user->role == 'admin' ? '#d4af37' : '#3b82f6' }}; color: #fff; padding:0.5rem 1rem;">
                        {{ ucfirst($user->role) }}
                    </span>

                    <!-- Email -->
                    <p class="text-muted mb-2"><i class="fas fa-envelope me-2"></i>Email</p>
                    <h5 class="fw-bold mb-3">{{ $user->email }}</h5>

                    <!-- Informations complémentaires -->
                    <div class="row g-3 mt-4">
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3">
                                <i class="fas fa-user-clock fa-2x text-gold mb-2"></i>
                                <div>
                                    <small class="d-block">Créé le</small>
                                    <strong>{{ $user->created_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3">
                                <i class="fas fa-calendar-check fa-2x text-gold mb-2"></i>
                                <div>
                                    <small class="d-block">Dernière mise à jour</small>
                                    <strong>{{ $user->updated_at->format('d/m/Y H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                        <a href="{{ route('Reservation.index') }}" class="btn btn-gold btn-lg">
                            <i class="fas fa-calendar-check me-2"></i>Mes Réservations
                        </a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-dashboard btn-lg">
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
    color: #9ca3af;
    margin-top: 6px;
}

/* CARTE DASHBOARD */
.card-dashboard {
    background: #fff;
    border-radius: 20px;
    padding: 35px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    transition: all .4s ease;
}
.card-dashboard:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(212,175,55,0.4);
}

/* BADGES */
.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

/* BORDURES */
.card-dashboard .border {
    border-color: #e5e7eb !important;
}

/* BOUTONS */
.btn-gold {
    background: linear-gradient(135deg,#d4af37,#f5d76e);
    color: #111827;
    border: none;
    border-radius: 30px;
    font-weight: 600;
    padding: 12px 28px;
    transition: all 0.3s ease;
}
.btn-gold:hover {
    transform: translateY(-2px) scale(1.03);
    box-shadow: 0 12px 30px rgba(212,175,55,0.45);
}

.btn-outline-dashboard {
    color: #111827;
    border: 1px solid #d4af37;
    border-radius: 30px;
    padding: 10px 24px;
}
.btn-outline-dashboard:hover {
    background: rgba(212,175,55,0.1);
}

/* ICONES GOLD */
.text-gold { color: #d4af37; }

/* RESPONSIVE */
@media (max-width: 768px) {
    .activities-title { font-size: 2rem; }
}
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
