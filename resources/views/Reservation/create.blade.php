@extends('layouts.app')

@section('title', 'Ajouter une Réservation - Kaizen Club')

@section('content')

<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-right">
                    <i class="fas fa-calendar-plus me-2"></i>Ajouter une Réservation
                </h2>
                <p class="activities-subtitle" data-aos="fade-left">
                    Pour l'activité : <strong>{{ $activite->nom }}</strong>
                </p>
            </div>
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

        <!-- Formulaire -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card-dashboard shadow-lg" data-aos="fade-up">
                    <div class="card-body p-4 p-md-5">

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</h6>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('Reservation.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="activite_sportif_id" value="{{ $activite->id }}">

                            <div class="row g-4">
                                <!-- Date -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-calendar-alt me-2 text-gold"></i>Date *
                                    </label>
                                    <input type="date"
                                           name="date"
                                           class="form-control input-custom @error('date') is-invalid @enderror"
                                           value="{{ old('date') }}"
                                           min="{{ date('Y-m-d') }}"
                                           required>
                                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <!-- Statut -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-info-circle me-2 text-gold"></i>Statut *
                                    </label>
                                    <select name="statut" class="form-select input-custom @error('statut') is-invalid @enderror" required>
                                        <option value="en attente" {{ old('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmée" {{ old('statut') == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="annulée" {{ old('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="d-flex gap-3 justify-content-end mt-5 flex-wrap">
                                <a href="{{ route('activiteSportif.show', $activite->id) }}" class="btn btn-outline-gold">
                                    <i class="fas fa-arrow-left me-2"></i>Retour
                                </a>
                                <button type="submit" class="btn btn-gold">
                                    <i class="fas fa-save me-2"></i>Enregistrer la réservation
                                </button>
                            </div>
                        </form>
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

/* ================== TITRES ================== */
.activities-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}

.activities-subtitle {
    font-size: 1.1rem;
    color: #374151;
    margin-top: 6px;
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

/* ================== FORMULAIRE ================== */
.card-dashboard {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    overflow: hidden;
    transition: all 0.4s ease;
}

.card-dashboard:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(212,175,55,0.25);
}

.input-custom {
    border-radius: 12px;
    padding: 12px 15px;
    border: 1.5px solid #d1d5db;
    background: #ffffff;
    color: #111827;
    transition: all 0.3s ease;
}
.input-custom:focus {
    border-color: #d4af37;
    box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.25);
}

.form-label {
    color: #111827;
    font-weight: 600;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 768px) {
    .activities-title { font-size: 2.2rem; }
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
