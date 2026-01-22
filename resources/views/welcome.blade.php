@extends('layouts.app')

@section('title', 'Kaizen Club - Bienvenue')

@section('content')

<!-- ================= HERO ================= -->
<section class="hero-kaizen">

    <div class="hero-overlay"></div>

    <div class="hero-content text-center">

        <!-- LOGO -->
        <div class="logo-kaizen mb-3" data-aos="zoom-in">
            <svg viewBox="0 0 200 200" class="logo-svg">
                <circle
                    class="drawing-circle"
                    cx="100"
                    cy="100"
                    r="78"
                    fill="none"
                    stroke="#d4af37"
                    stroke-width="2.4"
                    stroke-linecap="round"
                    stroke-dasharray="490"
                    stroke-dashoffset="490"
                />
                <text x="100" y="118" text-anchor="middle" class="letter-k">K</text>
            </svg>
        </div>

        <h1 class="hero-title" data-aos="fade-up">Kaizen Club</h1>

        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
            Grandir • Apprendre • Progresser
        </p>

        <p class="hero-description" data-aos="fade-up" data-aos-delay="400">
            Un club moderne inspiré par l’esprit du cheval :<br>
            discipline, confiance et amélioration continue.
        </p>

        <div class="hero-buttons" data-aos="zoom-in" data-aos-delay="600">
            <a href="{{ route('login') }}" class="btn btn-outline-kaizen btn-lg me-4">
                <i class="fas fa-sign-in-alt me-2"></i>Connexion
            </a>
            <a href="{{ route('club.decouvrir') }}" class="btn btn-primary-kaizen btn-lg">
                Découvrir le club
            </a>
        </div>

    </div>
</section>

@endsection

{{-- ================= STYLES ================= --}}
@section('styles')
<style>

/* ================= HERO – MAUVE UNIFIÉ ================= */
.hero-kaizen {
    position: relative;
    height: 100vh;
    min-height: 720px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #240046;          /* Mauve sombre fixe – plus de dégradé */
    overflow: hidden;
    font-family: 'Inter', system-ui, sans-serif;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.38);  /* Légèrement plus fort pour contraste */
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    color: #f8fafc;
    max-width: 920px;
    padding: 0 28px;
    text-shadow: 0 2px 14px rgba(0,0,0,0.6);
}

/* ================= LOGO ================= */
.logo-svg {
    width: 170px;
    height: 170px;
}

.drawing-circle {
    animation: drawCircle 4.8s ease forwards;
}

@keyframes drawCircle {
    to { stroke-dashoffset: 0; }
}

.letter-k {
    fill: #d4af37;
    font-family: 'Dancing Script', cursive;
    font-size: 120px;
    font-weight: 400;
    letter-spacing: -6px;
    dominant-baseline: middle;
}

/* ================= TEXTES ================= */
.hero-title {
    font-family: 'Dancing Script', cursive;
    font-size: 5.4rem;
    font-weight: 400;
    letter-spacing: -1.4px;
    margin: 16px 0 12px;
    color: #f8fafc;
}

.hero-subtitle {
    font-size: 1.6rem;
    font-weight: 300;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: rgba(248,250,252,0.92);
    margin-bottom: 28px;
}

.hero-description {
    font-size: 1.28rem;
    font-weight: 300;
    line-height: 1.65;
    color: rgba(248,250,252,0.90);
    max-width: 740px;
    margin: 0 auto 56px;
}

/* ================= BOUTONS ================= */
.btn-primary-kaizen,
.btn-outline-kaizen {
    font-family: 'Inter', sans-serif;
    font-size: 1.18rem;
    font-weight: 500;
    padding: 14px 56px;
    border-radius: 999px;
    transition: all 0.38s ease;
}

.btn-primary-kaizen {
    background: #d4af37;              /* Gold de base */
    color: #0f0f1a;
    border: none;
    box-shadow: 0 12px 36px rgba(212,175,55,0.42);
}

.btn-primary-kaizen:hover {
    background: #3a0ca3;              /* Mauve au hover */
    color: #f8fafc;
    transform: translateY(-6px);
    box-shadow: 0 24px 56px rgba(58,12,163,0.50);
}

.btn-outline-kaizen {
    border: 2.2px solid #d4af37;
    color: #d4af37;
    background: transparent;
}

.btn-outline-kaizen:hover {
    background: #d4af37;
    color: #0f0f1a;
    transform: translateY(-6px);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .hero-title { font-size: 4.4rem; }
}

@media (max-width: 768px) {
    .hero-title { font-size: 3.8rem; }
    .logo-svg   { width: 140px; height: 140px; }
    .letter-k   { font-size: 96px; }
    .hero-buttons {
        flex-direction: column;
        gap: 20px;
    }
    .btn-primary-kaizen,
    .btn-outline-kaizen {
        padding: 13px 48px;
    }
}

</style>

<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
        once: true,
        easing: 'ease-out-cubic'
    });
</script>
@endsection
