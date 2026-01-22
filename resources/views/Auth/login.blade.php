@extends('layouts.app')

@section('title', 'Connexion - Kaizen Club')

@section('content')
<!-- ================= HERO LOGIN ================= -->
<section class="hero-login">
    <div class="hero-overlay"></div>

    <div class="login-container text-center" data-aos="fade-up">
        <!-- SVG CHEVAL + K -->
        <div class="logo-login mb-4" data-aos="zoom-in">
            <svg viewBox="0 0 200 200" class="horse-svg">
                <path d="M100 20
                         C70 40, 50 80, 55 120
                         C60 155, 95 175, 100 180
                         C105 175, 140 155, 145 120
                         C150 80, 130 40, 100 20Z"/>
                <text x="100" y="125" text-anchor="middle" class="letter-k">K</text>
            </svg>
        </div>

        <!-- TITRE -->
        <h1 class="hero-title mb-2">Connexion</h1>
        <p class="hero-subtitle mb-4">Accédez à votre espace Kaizen Club</p>

        <!-- FORMULAIRE -->
        <div class="login-form-wrapper p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <!-- EMAIL -->
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold text-white">
                        <i class="fas fa-envelope me-2 text-gold"></i>Adresse email
                    </label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="exemple@gmail.com" value="{{ old('email') }}" required autofocus>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- CODE SECRET -->
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold text-white">
                        <i class="fas fa-lock me-2 text-gold"></i>Code secret
                    </label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- SE SOUVENIR DE MOI -->
                <div class="form-check mb-4 text-start">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-white" for="remember">Se souvenir de moi</label>
                </div>

                <!-- BOUTONS -->
                <button type="submit" class="btn btn-gold btn-lg w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>

                <a href="{{ route('register') }}" class="btn btn-outline-light w-100">
                    <i class="fas fa-user-plus me-2"></i>Créer un compte
                </a>
            </form>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
/* ================= HERO LOGIN ================= */
.hero-login {
    position: relative;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #2b1d14, #5a3d8a, #2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* FORMULAIRE */
.login-container {
    position: relative;
    z-index: 2;
    max-width: 400px;
    width: 100%;
    padding: 40px 30px;
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

/* SVG CHEVAL + K */
.horse-svg {
    width: 100px;
    height: 100px;
    fill: none;
    stroke: #d4af37;
    stroke-width: 3;
    animation: draw 3s ease forwards;
    margin: 0 auto;
}

.letter-k {
    fill: #d4af37;
    font-size: 48px;
    font-weight: 800;
}

@keyframes draw {
    from { stroke-dasharray: 600; stroke-dashoffset: 600; }
    to { stroke-dashoffset: 0; }
}

/* TEXTES */
.hero-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: #f5f5f5;
}

.hero-subtitle {
    color: #d4af37;
    font-size: 1.1rem;
    letter-spacing: 1px;
}

/* INPUTS */
.login-form-wrapper .form-control {
    border-radius: 12px;
    padding: 12px 15px;
    border: 2px solid rgba(212,175,55,0.3);
    background: rgba(255,255,255,0.15);
    color: #fff; /* texte blanc */
    font-weight: 500;
    text-shadow: 0 0 3px rgba(0,0,0,0.4);
}

/* Placeholder blanc */
.login-form-wrapper .form-control::placeholder {
    color: rgba(255,255,255,0.8);
    opacity: 1;
}

.login-form-wrapper .form-control:focus {
    border-color: #d4af37;
    background: rgba(255,255,255,0.25);
    box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.5);
    color: #fff;
}

/* BOUTONS */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #2b1d14;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-gold:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.5);
}

.btn-outline-light {
    border: 2px solid #fff;
    color: #fff;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-outline-light:hover {
    background: rgba(255,255,255,0.2);
    color: #fff;
    transform: translateY(-2px);
}

.alert {
    border-radius: 15px;
}

/* RESPONSIVE */
@media (max-width: 576px) {
    .login-container { padding: 30px 20px; }
    .hero-title { font-size: 2rem; }
}
</style>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({ duration:1200, once:true });

    // ================= AUTO-COMPLÉTION @gmail.com =================
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');

        emailInput.addEventListener('focus', function() {
            if (!emailInput.value.includes('@')) {
                emailInput.value = emailInput.value + '@gmail.com';
            }
        });

        emailInput.addEventListener('input', function() {
            const value = emailInput.value;
            if (value.includes('@') && !value.endsWith('@gmail.com')) {
                emailInput.value = value.split('@')[0] + '@gmail.com';
            }
        });
    });
</script>
@endsection
