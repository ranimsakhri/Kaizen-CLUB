@extends('layouts.app')

@section('title', 'Détails de la Réservation - Kaizen Club')

@section('content')
@auth
    @if(auth()->user()->role === 'admin')
        <!-- ================= HERO ADMIN ================= -->
        <section class="activities-hero">
            <div class="container py-5 text-center">

                <h2 class="activities-title" data-aos="fade-down">
                    <i class="fas fa-receipt me-2"></i>Détails de la Réservation
                </h2>
                <p class="activities-subtitle" data-aos="fade-up">
                    Réservation de l'utilisateur "<strong>{{ $reservation->user->name ?? 'N/A' }}</strong>"
                </p>
            </div>
        </section>

        <!-- ================= DETAILS ADMIN ================= -->
        <div class="container my-5" data-aos="fade-up">
            @php
                $color = match($reservation->statut) {
                    'en attente' => 'warning',
                    'confirmée' => 'success',
                    'annulée' => 'danger',
                    default => 'secondary',
                };
            @endphp

            <div class="card-activity h-100 text-center shadow-sm p-4">
                <h5 class="fw-bold text-gold mb-3">
                    Activité : {{ $reservation->activiteSportif->nom ?? 'N/A' }}
                </h5>
                <p class="text-gold">Type : {{ $reservation->activiteSportif->type ?? '' }}</p>
                <p class="text-gold">Durée : {{ $reservation->activiteSportif->duree ?? '' }} min</p>
                <p class="fw-bold text-gold">Prix : {{ number_format($reservation->activiteSportif->prix ?? 0,2) }} DT</p>
                <p class="text-gold">Capacité : {{ $reservation->activiteSportif->capacite ?? '' }} pers.</p>
                <p class="text-gold">
                    Statut :
                    <span class="badge bg-{{ $color }}">{{ ucfirst($reservation->statut) }}</span>
                </p>

                <div class="d-flex gap-3 justify-content-center mt-4 flex-wrap">
                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-gold">
                        <i class="fas fa-edit me-1"></i>Modifier
                    </a>
                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Supprimer cette réservation ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-dashboard">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </form>
                    <a href="{{ route('Reservation.index') }}" class="btn btn-outline-dashboard">
                        <i class="fas fa-arrow-left me-1"></i>Retour
                    </a>
                </div>
            </div>
        </div>

    @elseif(auth()->user()->role === 'user')
        <!-- ================= HERO USER ================= -->
        <section class="reservation-hero position-relative mb-5">
            <div class="hero-overlay"></div>
            <div class="container text-center hero-content py-5" data-aos="fade-up">
                <div class="hero-icon dynamic-icon mb-3">
                    <i class="fas fa-receipt"></i>
                </div>
                <h1 class="hero-title mb-2">Ma Réservation</h1>
            </div>
        </section>

        <!-- ================= DETAILS USER ================= -->
        <div class="container my-5" data-aos="fade-up">
            @php
                $color = match($reservation->statut) {
                    'en attente' => 'warning',
                    'confirmée' => 'success',
                    'annulée' => 'danger',
                    default => 'secondary',
                };
            @endphp

            <div class="card-activity h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="fw-bold text-gold">
                            Activité : {{ $reservation->activiteSportif->nom ?? 'N/A' }}
                        </h5>
                        <p class="text-gold">Type : {{ $reservation->activiteSportif->type ?? '' }}</p>
                        <p class="text-gold">Durée : {{ $reservation->activiteSportif->duree ?? '' }} min</p>
                        <p class="fw-bold text-gold">Prix : {{ number_format($reservation->activiteSportif->prix ?? 0,2) }} DT</p>
                        <p class="text-gold">Capacité : {{ $reservation->activiteSportif->capacite ?? '' }} pers.</p>
                        <p class="text-gold">
                            <strong>Statut :</strong>
                            <span class="badge bg-{{ $color }}">{{ ucfirst($reservation->statut) }}</span>
                        </p>
                    </div>

                    <div class="mt-3 d-flex gap-2 justify-content-center">
                        <a href="{{ route('Reservation.index') }}" class="btn btn-outline-gold w-45">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
@endsection

@section('styles')
<style>
/* ================= HERO ADMIN ================= */
.activities-hero {
    min-height: 25vh;
    background: linear-gradient(135deg,#f8fafc,#fff7e6,#fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border-radius: 20px;
}
@keyframes gradientBG { 0%{background-position:0% 50%;} 50%{background-position:100% 50%;} 100%{background-position:0% 50%;} }

.activities-title { font-size:2.4rem; font-weight:800; color:#111827; }
.activities-subtitle { font-size:1rem; color:#9ca3af; margin-top:6px; }

/* CARD ADMIN */
.card-activity { border-radius:20px; padding:20px; background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); color:#d4af37; transition: all 0.3s ease; }
.card-activity:hover { transform: translateY(-4px); box-shadow:0 10px 30px rgba(212,175,55,0.2); }

/* BUTTONS */
.btn-gold { background: linear-gradient(135deg,#d4af37,#f5d76e); color:#111827; border-radius:30px; font-weight:600; transition: all 0.3s ease; }
.btn-gold:hover { transform: translateY(-2px) scale(1.03); box-shadow:0 12px 30px rgba(212,175,55,0.45); }
.btn-outline-dashboard { border:1px solid #d4af37; color:#111827; border-radius:30px; transition:all 0.3s ease; }
.btn-outline-dashboard:hover { background:#fef9e0; }

/* USER HERO & CARD */
.reservation-hero { position: relative; min-height:25vh; background: linear-gradient(135deg,#2b1d14,#4a3c7a,#2b1d14); color:#d4af37; border-radius:20px; text-align:center; }
.hero-overlay { position:absolute; inset:0; background: rgba(0,0,0,0.4); border-radius:20px; }
.hero-icon { font-size:4rem; width:130px; height:130px; background: linear-gradient(135deg,#d4af37,#f5d76e); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#111827; margin:0 auto 20px; transition:all 0.45s ease; }
.hero-icon:hover { transform: scale(1.2) rotate(10deg); box-shadow:0 30px 65px rgba(212,175,55,0.45); }

.w-45 { width:45%; }
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1200, once: true });</script>
@endsection
