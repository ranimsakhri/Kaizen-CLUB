@extends('layouts.app')

@section('title', 'Découvrir Kaizen Club')

@section('content')

<!-- ================= HERO ================= -->
<section class="hero-kaizen">

    <div class="hero-overlay"></div>

    <div class="hero-content text-center">

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
            Un club jeune et moderne inspiré par l’esprit du cheval :<br>
            discipline, confiance et amélioration continue.
        </p>

        <div class="hero-buttons" data-aos="zoom-in" data-aos-delay="600">
            <a href="{{ route('login') }}" class="btn btn-outline-kaizen btn-lg me-4">
                <i class="fas fa-sign-in-alt me-2"></i> Connexion
            </a>
            <a href="#decouvrir-content" class="btn btn-primary-kaizen btn-lg">
                Découvrir le club
            </a>
        </div>

    </div>
</section>

<!-- ================= CONTENU PRINCIPAL ================= -->
<section id="decouvrir-content" class="section-decouvrir">
    <div class="container">

        <!-- FONDATRICE -->
        <div class="row align-items-center mb-5 pb-4" data-aos="fade-up">
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <i class="fas fa-horse-head founder-icon"></i>
            </div>
            <div class="col-md-7">
                <h3 class="section-title">La fondatrice</h3>
                <h5 class="founder-name">Ranim Sakhri</h5>
                <p class="section-text">
                    Passionnée par le sport, l’éducation et le développement personnel,
                    <strong>Ranim Sakhri</strong> a fondé Kaizen Club avec une vision claire :
                    créer un espace sûr et motivant où les enfants et les jeunes peuvent
                    apprendre, progresser et développer leur confiance en eux.
                </p>
                <p class="section-text">
                    Inspiré par l’esprit du cheval — symbole de force, discipline et élégance —,
                    Kaizen Club accompagne chaque membre dans son évolution personnelle.
                </p>
            </div>
        </div>

        <!-- ACTIVITÉS -->
        <div class="text-center mb-5 pb-3" data-aos="fade-up">
            <h2 class="section-title">Nos Activités</h2>
            <p class="section-subtitle">
                Des activités variées pour développer le corps et l’esprit
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="fas fa-horse"></i>
                    </div>
                    <h5>Équitation</h5>
                    <p>Apprendre la discipline, la confiance et le respect à travers le contact avec le cheval.</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h5>Activités Sportives</h5>
                    <p>Développement physique, coordination et esprit d’équipe à travers des activités adaptées aux jeunes.</p>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="activity-card">
                    <div class="activity-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5>Bien-être & Discipline</h5>
                    <p>Des séances pour renforcer la confiance en soi, la concentration et le bien-être mental.</p>
                </div>
            </div>
        </div>

        <!-- CTA FINAL -->
        <div class="text-center mt-5 pt-4" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('login') }}" class="btn btn-primary-kaizen btn-lg">
                Rejoindre Kaizen Club
            </a>
        </div>

    </div>
</section>

@endsection

{{-- ================= STYLES ================= --}}
@section('styles')
<style>

/* ================= HERO & SECTION – MAUVE UNIFIÉ ================= */
.hero-kaizen,
.section-decouvrir {
    background: #240046;          /* Mauve fixe – identique à welcome */
}

.hero-kaizen {
    position: relative;
    height: 100vh;
    min-height: 720px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.38);
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

/* ================= TEXTES HERO ================= */
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

/* ================= BOUTONS – même que welcome ================= */
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
    background: #d4af37;           /* Gold de base */
    color: #0f0f1a;
    border: none;
    box-shadow: 0 12px 36px rgba(212,175,55,0.42);
}

.btn-primary-kaizen:hover {
    background: #3a0ca3;           /* Mauve au hover */
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

/* ================= SECTION DÉCOUVRIR ================= */
.section-decouvrir {
    color: #f8fafc;
    padding: 100px 0 120px;
}

.section-title {
    font-family: 'Dancing Script', cursive;
    font-size: 4.4rem;
    font-weight: 400;
    letter-spacing: -1.2px;
    color: #f8fafc;
    margin-bottom: 1.3rem;
    text-align: center;
}

.section-subtitle {
    font-size: 1.45rem;
    font-weight: 300;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: rgba(248,250,252,0.88);
    margin-bottom: 3.2rem;
    text-align: center;
}

.section-text {
    font-size: 1.22rem;
    line-height: 1.68;
    color: rgba(248,250,252,0.90);
    font-weight: 300;
}

.founder-name {
    color: #d4af37;
    font-size: 1.9rem;
    font-weight: 500;
    margin: 1.1rem 0 1.6rem;
}

.founder-icon {
    font-size: 9.5rem;
    color: #d4af37;
    opacity: 0.88;
}

/* ================= CARTES ACTIVITÉS ================= */
.activity-card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 20px;
    padding: 2.4rem 1.9rem;
    text-align: center;
    transition: all 0.42s ease;
    min-height: 270px;
}

.activity-card:hover {
    transform: translateY(-14px);
    box-shadow: 0 28px 70px rgba(0,0,0,0.48);
    background: rgba(255,255,255,0.08);
}

.activity-icon {
    font-size: 3.4rem;
    color: #d4af37;
    margin-bottom: 1.5rem;
}

.activity-card h5 {
    font-size: 1.48rem;
    font-weight: 500;
    margin-bottom: 1.1rem;
    color: #f8fafc;
}

.activity-card p {
    font-size: 1.08rem;
    color: rgba(248,250,252,0.82);
    line-height: 1.62;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .hero-title { font-size: 4.4rem; }
    .section-title { font-size: 3.8rem; }
}

@media (max-width: 768px) {
    .hero-title       { font-size: 3.8rem; }
    .section-title    { font-size: 3.3rem; }
    .logo-svg         { width: 140px; height: 140px; }
    .letter-k         { font-size: 96px; }
    .hero-buttons     { flex-direction: column; gap: 20px; }
    .founder-icon     { font-size: 7.5rem; }
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
