@extends('layouts.app')

@section('title', 'Kaizen Club - Bienvenue')

@section('content')

<!-- ================= HERO ================= -->
<section class="hero-kaizen">

    <div class="hero-overlay"></div>

    <div class="hero-content text-center">

        <!-- LOGO SVG CHEVAL + K -->
        <div class="logo-kaizen" data-aos="zoom-in">
            <svg viewBox="0 0 200 200" class="horse-svg">
                <path d="M100 20
                         C70 40, 50 80, 55 120
                         C60 155, 95 175, 100 180
                         C105 175, 140 155, 145 120
                         C150 80, 130 40, 100 20Z"/>
                <text x="100" y="125" text-anchor="middle" class="letter-k">K</text>
            </svg>
        </div>

        <h1 class="hero-title" data-aos="fade-up">Kaizen Club</h1>

        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
            Grandir • Apprendre • Progresser
        </p>

        <p class="hero-text" data-aos="fade-up" data-aos-delay="400">
            Un club jeune et moderne inspiré par l’esprit du cheval :
            discipline, confiance et amélioration continue.
        </p>

        <div class="hero-buttons" data-aos="zoom-in" data-aos-delay="600">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg me-3">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </a>
            <a href="{{ route('club.decouvrir') }}" class="btn btn-gold btn-lg">
    Découvrir le club
</a>

        </div>

    </div>
</section>

@endsection

{{-- ================= STYLES ================= --}}
@section('styles')
<style>

/* ================= HERO ================= */
.hero-kaizen {
    position: relative;
    height: 100vh;
    background: linear-gradient(
        135deg,
        #2b1d14,
        #5a3d8a,
        #2b1d14
    );
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
}

/* ANIMATION DU GRADIENT */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* OVERLAY */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 1;
}

/* CONTENT */
.hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    color: #f5f5f5;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* SVG LOGO */
.horse-svg {
    width: 160px;
    height: 160px;
    fill: none;
    stroke: #d4af37;
    stroke-width: 4;
    animation: draw 3s ease forwards;
}

@keyframes draw {
    from {
        stroke-dasharray: 600;
        stroke-dashoffset: 600;
    }
    to {
        stroke-dashoffset: 0;
    }
}

/* LETTRE K */
.letter-k {
    fill: #d4af37;
    font-size: 64px;
    font-weight: 800;
}

/* TEXT */
.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-top: 20px;
}

.hero-subtitle {
    color: #d4af37;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-size: 1.2rem;
}

.hero-text {
    max-width: 600px;
    margin-top: 15px;
    font-size: 1.1rem;
    opacity: 0.95;
}

/* BUTTONS */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #2b1d14;
    border-radius: 30px;
    padding: 12px 32px;
    font-weight: 600;
    border: none;
}

.btn-gold:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.5);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.4rem;
    }
}

</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
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
</script>
@endsection
