@extends('layouts.app')

@section('title', 'Modifier la Réservation - Kaizen Club')

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="mb-4 text-center">
            <h2 class="activities-title" data-aos="fade-down">
                <i class="fas fa-edit me-2"></i>Modifier la Réservation
            </h2>
            <p class="activities-subtitle" data-aos="fade-up">
                Mettez à jour les informations de la réservation pour "<strong>{{ $reservation->activiteSportif->nom }}</strong>"
            </p>
        </div>

        <!-- Erreurs -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-exclamation-triangle me-2"></i>Veuillez corriger les erreurs ci-dessous.
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST" data-aos="fade-up">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- Date -->
                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fas fa-calendar-alt me-2 text-gold"></i>Date de la réservation *</label>
                    <input type="date" name="date" class="form-control input-dashboard @error('date') is-invalid @enderror"
                           value="{{ old('date', $reservation->date) }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Statut -->
                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fas fa-info-circle me-2 text-gold"></i>Statut *</label>
                    <select name="statut" class="form-select input-dashboard @error('statut') is-invalid @enderror" required>
                        <option value="en attente" {{ old('statut', $reservation->statut)=='en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmée" {{ old('statut', $reservation->statut)=='confirmée' ? 'selected' : '' }}>Confirmée</option>
                        <option value="annulée" {{ old('statut', $reservation->statut)=='annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4 flex-wrap">
                <a href="{{ route('Reservation.index') }}" class="btn btn-outline-dashboard btn-lg">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-gold btn-lg">
                    <i class="fas fa-save me-2"></i>Enregistrer
                </button>
            </div>
        </form>

    </div>
</section>
@endsection

@section('styles')
<style>
/* ================== HERO & FOND ================== */
.activities-hero {
    min-height: 80vh;
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

/* TITRES */
.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}

.activities-subtitle {
    font-size: 1rem;
    color: #9ca3af;
    margin-top: 6px;
}

/* INPUTS */
.input-dashboard {
    border-radius: 12px;
    padding: 12px 15px;
    border: 1.5px solid #d1d5db;
    background: #ffffff;
    color: #111827;
    font-weight: 500;
}

.input-dashboard::placeholder {
    color: #6b7280;
}

.input-dashboard:focus {
    border-color: #d4af37;
    box-shadow: 0 0 0 0.18rem rgba(212,175,55,0.25);
}

/* LABELS */
label {
    color: #111827;
    font-weight: 600;
}

label i {
    color: #d4af37;
}

/* BOUTONS */
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
}

.btn-outline-dashboard {
    color: #111827;
    border: 1px solid #d4af37;
    border-radius: 30px;
}

.btn-outline-dashboard:hover {
    background: rgba(212,175,55,0.1);
}

/* ALERTES */
.alert-danger {
    border-radius: 14px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .activities-title {
        font-size: 2rem;
    }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
