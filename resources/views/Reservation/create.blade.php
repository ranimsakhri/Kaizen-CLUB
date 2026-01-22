@extends('layouts.app')

@section('title', 'Ajouter une Réservation - Kaizen Club')

@section('content')
<!-- ================= HERO ================= -->
<section class="reservation-hero position-relative mb-5">
    <div class="hero-overlay"></div>
    <div class="container text-center hero-content py-5" data-aos="fade-up">
        <div class="hero-icon dynamic-icon mb-3">
            <i class="fas fa-calendar-plus"></i>
        </div>
        <h1 class="hero-title mb-2">Ajouter une Réservation</h1>
        <p class="hero-subtitle">Pour l'activité : <strong>{{ $activite->nom }}</strong></p>
    </div>
</section>

<!-- ================= FORMULAIRE ================= -->
<div class="container">
    <div class="form-wrapper p-4 p-md-5 bg-light rounded-4 shadow-sm" data-aos="fade-up">

        <!-- Erreurs -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
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
            <!-- Champ caché pour l'activité -->
            <input type="hidden" name="activite_sportif_id" value="{{ $activite->id }}">

            <div class="row g-4">
                <!-- Date -->
                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fas fa-calendar-alt me-2 text-gold"></i>Date *</label>
                    <input type="date"
                           name="date"
                           class="form-control input-custom @error('date') is-invalid @enderror"
                           value="{{ old('date') }}"
                           min="{{ date('Y-m-d') }}" {{-- empêche les dates passées --}}
                           required>
                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Statut -->
                <div class="col-md-6">
                    <label class="form-label fw-bold"><i class="fas fa-info-circle me-2 text-gold"></i>Statut *</label>
                    <select name="statut" class="form-select input-custom @error('statut') is-invalid @enderror" required>
                        <option value="en attente" {{ old('statut')=='en attente'?'selected':'' }}>En attente</option>
                        <option value="confirmée" {{ old('statut')=='confirmée'?'selected':'' }}>Confirmée</option>
                        <option value="annulée" {{ old('statut')=='annulée'?'selected':'' }}>Annulée</option>
                    </select>
                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4 flex-wrap">
                <a href="{{ route('activiteSportif.show', $activite->id) }}" class="btn btn-outline-secondary btn-action">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
                <button type="submit" class="btn btn-gold btn-action">
                    <i class="fas fa-save me-2"></i>Enregistrer la réservation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
/* ================= HERO ================= */
.reservation-hero {
    position: relative;
    min-height: 25vh;
    background: linear-gradient(135deg, #2b1d14, #4a3c7a, #2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f5f5f5;
    text-align: center;
    margin-bottom: 3rem;
    border-radius: 20px;
}
.hero-overlay { position:absolute; inset:0; background: rgba(0,0,0,0.4); border-radius: 20px; z-index:1; }
.hero-content { position: relative; z-index:2; }
.hero-title { font-size:2.5rem; font-weight:800; }
.hero-subtitle { color:#d4af37; letter-spacing:1.5px; }

/* ================= ICON DYNAMIQUE ================= */
.dynamic-icon {
    font-size:3.5rem;
    width:100px;
    height:100px;
    background: linear-gradient(135deg,#d4af37,#f5d76e);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#111827;
    margin:0 auto 20px;
    transition: all 0.45s ease;
}
.dynamic-icon:hover { transform: scale(1.2) rotate(10deg); box-shadow:0 20px 50px rgba(212,175,55,0.4); }

/* ================= FORMULAIRE ================= */
.form-wrapper {
    background:#ffffff;
    border-radius:24px;
    box-shadow:0 20px 50px rgba(0,0,0,0.08);
    transition: all 0.35s ease;
}
.form-wrapper:hover { transform: translateY(-4px); }

/* INPUTS */
.input-custom {
    border-radius:12px;
    padding:12px 15px;
    border:1.5px solid #d1d5db;
    background:#ffffff;
    color:#111827;
    font-weight:500;
    transition: all 0.3s ease;
}
.input-custom:focus { border-color:#d4af37; box-shadow:0 0 0 0.18rem rgba(212,175,55,0.25); }

/* LABELS ICÔNES */
label i { color:#d4af37; transition: transform 0.3s ease; }
label:hover i { transform: rotate(-5deg) scale(1.1); }

/* BOUTONS */
.btn-action {
    border-radius:40px;
    font-weight:600;
    letter-spacing:1px;
    position:relative;
    overflow:hidden;
    transition: all 0.3s ease;
}
.btn-action::after {
    content:"";
    position:absolute;
    inset:0;
    background: linear-gradient(120deg,transparent,rgba(212,175,55,0.25),transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}
.btn-action:hover::after { transform: translateX(100%); }

.btn-gold {
    background: linear-gradient(135deg,#d4af37,#f1d27a);
    color:#111827;
    border:none;
    font-weight:600;
    transition: all 0.3s ease;
}
.btn-gold:hover { transform: translateY(-2px) scale(1.03); box-shadow:0 12px 30px rgba(212,175,55,0.45); }

.btn-outline-secondary {
    color:#374151;
}
.btn-outline-secondary:hover { color:#111827; border-color:#d4af37; background: rgba(212,175,55,0.08); }

/* ANIMATIONS GRADIENT */
@keyframes gradientMove {
    0% { background-position:0% 50%; }
    50% { background-position:100% 50%; }
    100% { background-position:0% 50%; }
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
