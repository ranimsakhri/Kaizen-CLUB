@extends('layouts.app')

@section('title', 'Réservations - Kaizen Club')

@section('content')

@auth
    @if(auth()->user()->is_admin)
        <!-- ================= ADMIN HERO ================= -->
        <section class="activities-hero">
            <div class="container py-5 text-center">
                <h2 class="activities-title mb-2" data-aos="fade-down">
                    <i class="fas fa-calendar-check me-2"></i>Toutes les Réservations
                </h2>

                <!-- BOUTON RETOUR -->
                <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-gold mb-4">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux activités
                </a>

                <p class="activities-subtitle" data-aos="fade-up">
                    Toutes les réservations enregistrées par les utilisateurs
                </p>
            </div>
        </section>

        <div class="container my-5" data-aos="fade-up">
            @if($reservations->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucune réservation disponible</h4>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-reservations">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Utilisateur</th>
                                <th>Activité</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                                    <td>{{ $reservation->activiteSportif->nom ?? 'N/A' }} ({{ $reservation->activiteSportif->type ?? '' }})</td>
                                    <td>{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                                    <td>
                                        @php
                                            $color = match($reservation->statut) {
                                                'en attente' => 'warning',
                                                'confirmée' => 'success',
                                                'annulée' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $color }}">{{ ucfirst($reservation->statut) }}</span>
                                    </td>
                                    <td class="d-flex gap-2 flex-wrap">
                                        <a href="{{ route('Reservation.show', $reservation->id) }}" class="btn btn-gold btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-gold btn-sm"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-dashboard btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    @else
        <!-- ================= USER HERO ================= -->
        <section class="activities-hero">
            <div class="container py-5 text-center">
                <h2 class="activities-title mb-2" data-aos="fade-down">
                    <i class="fas fa-calendar-check me-2"></i>Mes Réservations
                </h2>

                <!-- BOUTON RETOUR -->
                <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-gold mb-4">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux activités
                </a>

                <p class="activities-subtitle" data-aos="fade-up">
                    Toutes vos réservations personnelles
                </p>
            </div>
        </section>

        <div class="container my-5" data-aos="fade-up">
            @if($reservations->isEmpty())
                <p class="text-center text-gold py-5">Vous n'avez effectué aucune réservation.</p>
            @else
                <div class="row g-4">
                    @foreach($reservations as $reservation)
                        <div class="col-md-6 col-lg-4">
                            <div class="card-activity h-100 shadow-sm text-center">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <i class="fas fa-dumbbell fa-3x mb-3 text-gold"></i>
                                        <h5 class="fw-bold text-gold">{{ $reservation->activiteSportif->nom }}</h5>
                                        <p class="text-gold">Date : {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
                                        <p class="text-gold">Statut : {{ ucfirst($reservation->statut) }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('Reservation.show', $reservation->id) }}" class="btn btn-outline-gold w-100">
                                            Voir
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
@endauth

@endsection

@section('styles')
<style>
/* ================= HERO ================= */
.activities-hero {
    min-height: 25vh;
    background: linear-gradient(135deg,#f8fafc,#fff7e6,#fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
    display: flex; justify-content: center; align-items: center;
    border-radius: 20px; text-align: center;
}
@keyframes gradientBG { 0% {background-position:0% 50%;} 50% {background-position:100% 50%;} 100% {background-position:0% 50%;} }

.activities-title { font-size: 2.4rem; font-weight: 800; color: #111827; }
.activities-subtitle { font-size: 1rem; color: #9ca3af; margin-top: 6px; }

/* TABLE ADMIN */
.table-reservations { background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08); }
.table-reservations thead { background:#111827; color:#d4af37; text-transform:uppercase; font-size:0.85rem; }
.table-reservations tbody tr:hover { background: rgba(212,175,55,0.08); }

/* USER CARDS */
.card-activity { border-radius:20px; padding:20px; background: rgba(255,255,255,0.08); backdrop-filter: blur(14px); color:#d4af37; transition: all 0.3s ease; }
.card-activity:hover { transform: translateY(-4px); box-shadow:0 10px 30px rgba(212,175,55,0.2); }

/* BUTTONS */
.btn-gold { background: linear-gradient(135deg,#d4af37,#f5d76e); color:#111827; border-radius:30px; font-weight:600; }
.btn-gold:hover { transform: translateY(-2px) scale(1.03); box-shadow:0 12px 30px rgba(212,175,55,0.45); }
.btn-outline-gold { border:1px solid #d4af37; color:#d4af37; border-radius:30px; transition:all 0.3s ease; }
.btn-outline-gold:hover { background:#d4af37; color:#111827; }
.w-100 { width:100%; }
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> AOS.init({ duration: 1200, once: true }); </script>
@endsection
