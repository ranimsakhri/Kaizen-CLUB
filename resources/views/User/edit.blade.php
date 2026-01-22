@extends('layouts.app')

@section('title', 'Modifier ' . $user->name . ' - Kaizen Club')

@section('content')

@if(auth()->user()->role == 'admin')
<!-- ================= ADMIN HERO ================= -->
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

        <h1 class="hero-title mb-2">Modifier l'utilisateur</h1>
        <p class="hero-subtitle">Gestion des utilisateurs – Administrateur</p>
    </div>
</section>

<div class="container my-5">
    <div class="form-wrapper p-4 p-md-5 bg-light rounded-4 shadow-sm" data-aos="fade-up">
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

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <!-- Nom -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold"><i class="fas fa-user me-2 text-gold"></i>Nom *</label>
                    <input type="text" name="name" id="name" class="form-control input-custom @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold"><i class="fas fa-envelope me-2 text-gold"></i>Email *</label>
                    <input type="email" name="email" id="email" class="form-control input-custom @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Mot de passe -->
                <div class="col-md-6">
                    <label for="password" class="form-label fw-bold"><i class="fas fa-lock me-2 text-gold"></i>Mot de passe
                        <small class="text-muted">(laisser vide si inchangé)</small></label>
                    <input type="password" name="password" id="password" class="form-control input-custom @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Rôle (ADMIN uniquement) -->
                <div class="col-md-6">
                    <label for="role" class="form-label fw-bold"><i class="fas fa-user-shield me-2 text-gold"></i>Rôle *</label>
                    <select name="role" id="role" class="form-select input-custom @error('role') is-invalid @enderror" required>
                        <option value="">-- Sélectionner un rôle --</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end mt-4 flex-wrap">
                <a href="{{ route('users.index') }}" class="btn btn-outline-dashboard btn-action"><i class="fas fa-arrow-left me-2"></i>Annuler</a>
                <button type="submit" class="btn btn-gold btn-action"><i class="fas fa-save me-2"></i>Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

@else
<!-- ================= USER HERO ================= -->
<section class="hero-dashboard">
    <div class="hero-overlay"></div>
    <div class="hero-content container py-5">
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="hero-title fw-bold"><i class="fas fa-user me-2"></i>{{ $user->name }}</h1>
            <p class="hero-subtitle">Modifier votre profil</p>
        </div>

        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-md-6">
                <div class="card-glass p-4 text-center shadow">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 text-start">
                            <label for="name" class="form-label fw-bold">Nom</label>
                            <input type="text" name="name" id="name" class="form-control input-custom"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" id="email" class="form-control input-custom"
                                   value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="password" class="form-label fw-bold">Mot de passe
                                <small class="text-muted">(laisser vide si inchangé)</small>
                            </label>
                            <input type="password" name="password" id="password" class="form-control input-custom">
                        </div>

                        <button type="submit" class="btn btn-gold btn-action w-100">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@section('styles')
<style>
/* ADMIN HERO */
.reservations-hero {
    position: relative;
    min-height: 35vh;
    background: linear-gradient(135deg, #fff8e1, #fff3d1, #fdf1c2);
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.05); }
.hero-content { position: relative; z-index: 2; }
.hero-svg { width: 100px; height: 100px; fill: none; stroke: #bfa136; stroke-width: 4; animation: draw 3s ease forwards; }
@keyframes draw { from { stroke-dasharray: 600; stroke-dashoffset: 600; } to { stroke-dashoffset: 0; } }
.letter-k { fill: #bfa136; font-size: 48px; font-weight: 800; }
.hero-title { font-size: 2.2rem; font-weight: 800; color: #bfa136; }
.hero-subtitle { color: #bfa136; letter-spacing: 1.5px; }

/* USER DASHBOARD HERO */
.hero-dashboard {
    position: relative;
    min-height: 80vh;
    background: linear-gradient(135deg, #2b1d14, #9b70d0, #2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    font-family: 'Poppins', sans-serif;
    padding-top: 60px;
    padding-bottom: 60px;
}
@keyframes gradientMove { 0% {background-position:0% 50%;} 50% {background-position:100% 50%;} 100% {background-position:0% 50%;} }
.hero-dashboard .hero-overlay { background: rgba(0,0,0,0.6); }
.hero-dashboard .hero-title { font-size: 2.8rem; font-weight: 800; }
.hero-dashboard .hero-subtitle { color: #bfa136; letter-spacing: 2px; text-transform: uppercase; }

/* FORMULAIRE COMMUN */
.form-wrapper, .card-glass {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 30px;
    box-shadow:0 20px 50px rgba(0,0,0,0.08);
}
.input-custom { border-radius:12px; padding:12px 15px; border:1.5px solid #d1d5db; }
.input-custom:focus { border-color:#bfa136; box-shadow:0 0 0 0.18rem rgba(191,161,54,0.25); }
.btn-action { border-radius:40px; font-weight:600; letter-spacing:1px; position:relative; overflow:hidden; transition: all 0.3s ease; }
.btn-action::after { content:""; position:absolute; inset:0; background: linear-gradient(120deg,transparent,rgba(191,161,54,0.25),transparent); transform: translateX(-100%); transition: transform 0.6s ease; }
.btn-action:hover::after { transform: translateX(100%); }
.btn-gold { background: linear-gradient(135deg,#bfa136,#ffd700); color:#111827; border:none; font-weight:600; }
.btn-gold:hover { transform: translateY(-2px) scale(1.03); box-shadow:0 12px 30px rgba(191,161,54,0.45); }
.btn-outline-dashboard { color: #111827; border: 1px solid #bfa136; border-radius: 30px; padding: 6px 16px; }
.btn-outline-dashboard:hover { background: rgba(191,161,54,0.1); }

@media (max-width:768px){.hero-title{font-size:2.2rem;}}
</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration: 1200, once: true });</script>
@endsection
