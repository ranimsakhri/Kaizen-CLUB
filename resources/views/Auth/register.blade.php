@extends('layouts.app')

@section('title', 'Inscription - Kaizen Club')

@section('content')

<!-- ================= HERO REGISTER ================= -->
<section class="hero-register">

    <div class="hero-overlay"></div>

    <div class="hero-content container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <!-- LEFT : BRAND -->
            <div class="col-lg-5 text-center text-lg-start mb-5 mb-lg-0" data-aos="fade-right">
                <div class="logo-kaizen mb-4" data-aos="zoom-in">
                    <svg viewBox="0 0 200 200" class="horse-svg">
                        <path d="M100 20
                                 C70 40, 50 80, 55 120
                                 C60 155, 95 175, 100 180
                                 C105 175, 140 155, 145 120
                                 C150 80, 130 40, 100 20Z"/>
                        <text x="100" y="125" text-anchor="middle" class="letter-k">K</text>
                    </svg>
                </div>

                <h1 class="hero-title">Rejoins Kaizen Club</h1>
                <p class="hero-subtitle">Grandir • Apprendre • Progresser</p>
                <p class="hero-text">
                    Crée ton compte et commence ton parcours
                    basé sur la discipline, la confiance et l’amélioration continue.
                </p>
            </div>

            <!-- RIGHT : FORM -->
            <div class="col-lg-5" data-aos="fade-left">
                <div class="register-card">

                    <h3 class="fw-bold mb-4 text-center">
                        <i class="fas fa-user-plus me-2 text-gold"></i> Inscription
                    </h3>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="exemple@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-gold w-100">
                            <i class="fas fa-user-check me-2"></i> Créer mon compte
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-light text-decoration-none">
                            Déjà un compte ? Se connecter
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

{{-- ================= STYLES ================= --}}
@section('styles')
<style>
.hero-register {
    position: relative;
    min-height: 100vh;
    background: linear-gradient(135deg, #2b1d14, #5a3d8a, #2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    font-family: 'Poppins', sans-serif;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
}

.hero-content {
    position: relative;
    z-index: 2;
    color: #f5f5f5;
}

.horse-svg {
    width: 130px;
    height: 130px;
    fill: none;
    stroke: #d4af37;
    stroke-width: 2.4;
    animation: drawHorse 4.5s ease forwards;
    margin: 0 auto 20px;
}

@keyframes drawHorse {
    from { stroke-dasharray: 600; stroke-dashoffset: 600; }
    to   { stroke-dashoffset: 0; }
}

.letter-k {
    fill: #d4af37;
    font-family: 'Dancing Script', cursive;
    font-size: 62px;
    font-weight: 400;
    dominant-baseline: middle;
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
}

.hero-subtitle {
    color: #d4af37;
    letter-spacing: 3px;
    text-transform: uppercase;
}

.hero-text {
    max-width: 450px;
    opacity: 0.95;
}

.register-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(14px);
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}

.register-card label {
    color: #f5f5f5;
    font-weight: 500;
}

.register-card .form-control {
    background: rgba(255,255,255,0.15);
    border: none;
    color: #fff;
    border-radius: 10px;
}

.register-card .form-control::placeholder {
    color: rgba(255,255,255,0.7);
}

.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #2b1d14;
    border-radius: 30px;
    padding: 12px;
    font-weight: 600;
    border: none;
}

.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.5);
}

.text-gold {
    color: #d4af37;
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&family=Dancing+Script:wght@400;500&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

{{-- ================= SCRIPTS ================= --}}
@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
        once: true
    });

    document.addEventListener('DOMContentLoaded', function () {

        // Complétion automatique @gmail.com (conservée)
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('input', function () {
            let value = emailInput.value.trim();
            if (value.includes('@')) return;

            const pos = emailInput.selectionStart;
            emailInput.value = value + '@gmail.com';
            emailInput.setSelectionRange(pos, pos);
        });

        // Plus de toggle password ici
    });
</script>
@endsection
