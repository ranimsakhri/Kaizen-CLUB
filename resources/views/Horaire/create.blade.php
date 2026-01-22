@extends('layouts.app')

@section('title', 'Ajouter un Horaire - Kaizen Club')

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="mb-4 text-center">
            <h2 class="activities-title" data-aos="fade-down">
                <i class="fas fa-plus-circle me-2 text-gold"></i>Ajouter un Nouvel Horaire
            </h2>
            <p class="activities-subtitle" data-aos="fade-up">
                Complétez le formulaire pour créer un nouvel horaire
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
        <form action="{{ route('horaire.store') }}" method="POST" data-aos="fade-up">
            @csrf
            <input type="hidden" name="activite_sportif_id" value="{{ $activiteSportif->id }}">

            <div class="row g-4">

                <!-- Date -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-calendar-alt me-2 text-gold"></i>Date *
                    </label>
                    <input type="date"
                           name="date"
                           class="form-control input-dashboard @error('date') is-invalid @enderror"
                           value="{{ old('date') }}"
                           required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure de début -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-clock me-2 text-gold"></i>Heure de début *
                    </label>
                    <input type="time"
                           name="heure_debut"
                           class="form-control input-dashboard @error('heure_debut') is-invalid @enderror"
                           value="{{ old('heure_debut') }}"
                           required>
                    @error('heure_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure de fin -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-clock me-2 text-gold"></i>Heure de fin *
                    </label>
                    <input type="time"
                           name="heure_fin"
                           class="form-control input-dashboard @error('heure_fin') is-invalid @enderror"
                           value="{{ old('heure_fin') }}"
                           required>
                    @error('heure_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4 flex-wrap">
                <a href="{{ route('activiteSportif.show', $activiteSportif->id) }}" class="btn btn-outline-dashboard btn-lg">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-gold btn-lg">
                    <i class="fas fa-save me-2"></i>Enregistrer l'horaire
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
    padding: 10px 20px;
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
