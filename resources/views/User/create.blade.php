@extends('layouts.app')

@section('title', 'Ajouter un utilisateur - Kaizen Club')

@section('content')
<!-- ================= HERO ================= -->
<section class="reservations-hero position-relative mb-5">
    <div class="hero-overlay"></div>

    <div class="container text-center py-5 hero-content" data-aos="fade-up">
        <div class="logo-kaizen mb-4" data-aos="zoom-in">
            <svg viewBox="0 0 200 200" class="hero-svg">
                <path d="M100 20
                         C70 40, 50 80, 55 120
                         C60 155, 95 175, 100 180
                         C105 175, 140 155, 145 120
                         C150 80, 130 40, 100 20Z"/>
                <text x="100" y="125" text-anchor="middle" class="letter-k">K</text>
            </svg>
        </div>

        <h1 class="hero-title mb-2">Ajouter un utilisateur</h1>
        <p class="hero-subtitle">Création d’un nouvel utilisateur – Administrateur</p>
    </div>
</section>

<!-- ================= FORMULAIRE ================= -->
<div class="container my-5">
    <div class="form-wrapper p-4 p-md-5 bg-light rounded-4 shadow-sm" data-aos="fade-up">

        <!-- Erreurs -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</h6>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                <!-- Nom -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold">
                        <i class="fas fa-user me-2 text-gold"></i>Nom *
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control input-custom @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Ex: Ahmed Werghmi"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">
                        <i class="fas fa-envelope me-2 text-gold"></i>Email *
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control input-custom @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="Ex: utilisateur@example.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="col-md-6">
                    <label for="password" class="form-label fw-bold">
                        <i class="fas fa-lock me-2 text-gold"></i>Mot de passe *
                    </label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control input-custom @error('password') is-invalid @enderror"
                           placeholder="Choisissez un mot de passe"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rôle -->
                <div class="col-md-6">
                    <label for="role" class="form-label fw-bold">
                        <i class="fas fa-user-shield me-2 text-gold"></i>Rôle *
                    </label>
                    <select name="role" id="role" class="form-select input-custom @error('role') is-invalid @enderror" required>
                        <option value="">-- Sélectionner un rôle --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4 flex-wrap">
                <a href="{{ route('users.index') }}" class="btn btn-outline-dashboard btn-action">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-gold btn-action">
                    <i class="fas fa-save me-2"></i>Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
/* ================= HERO ================= */
.reservations-hero {
    position: relative;
    min-height: 35vh;
    background: linear-gradient(135deg, #fef9e0, #fff7e6, #f8fafc);
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.05); }
.hero-content { position: relative; z-index: 2; }
.hero-svg { width: 100px; height: 100px; fill: none; stroke: #d4af37; stroke-width: 4; animation: draw 3s ease forwards; }
@keyframes draw { from { stroke-dasharray:600; stroke-dashoffset:600; } to { stroke-dashoffset:0; } }
.letter-k { fill: #d4af37; font-size: 48px; font-weight: 800; }
.hero-title { font-size:2.2rem; font-weight:800; color:#d4af37; }
.hero-subtitle { color:#d4af37; letter-spacing:1.5px; }

/* ================= FORMULAIRE ================= */
.form-wrapper {
    background:#ffffff;
    border-radius:24px;
    box-shadow:0 20px 50px rgba(0,0,0,0.08);
    transition: all 0.35s ease;
}
.form-wrapper:hover { transform: translateY(-4px); }

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
    background: linear-gradient(135deg,#d4af37,#f5d76e);
    color:#111827;
    border:none;
    font-weight:600;
    transition: all 0.3s ease;
}
.btn-gold:hover { transform: translateY(-2px) scale(1.03); box-shadow:0 12px 30px rgba(212,175,55,0.45); }

.btn-outline-dashboard {
    color: #111827;
    border: 1px solid #d4af37;
    border-radius: 30px;
    padding: 6px 16px;
}
.btn-outline-dashboard:hover { background: rgba(212,175,55,0.1); }
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> AOS.init({ duration: 1200, once: true }); </script>
@endsection

