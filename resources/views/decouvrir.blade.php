@extends('layouts.app')

@section('title', 'Découvrir Kaizen Club')

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
            <a href="#decouvrir-content" class="btn btn-gold btn-lg">
                Découvrir le club
            </a>
        </div>

    </div>
</section>

<!-- ================= CONTENU ================= -->
<section id="decouvrir-content" class="py-5" style="background:#f8f8f8;">
    <div class="container">

        <!-- FONDATRICE -->
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-md-5 text-center mb-3">
                <i class="fas fa-horse-head founder-icon"></i>
            </div>
            <div class="col-md-7">
                <h3 class="fw-bold hero-title">La fondatrice</h3>
                <h5 class="text-gold">Ranim Sakhri</h5>
                <p class="mt-3">
                    Passionnée par le sport, l’éducation et le développement personnel,
                    <strong>Ranim Sakhri</strong> a fondé Kaizen Club avec une vision claire :
                    créer un espace sûr et motivant où les enfants et les jeunes peuvent
                    apprendre, progresser et développer leur confiance en eux.
                </p>
                <p>
                    Inspiré par l’esprit du cheval — symbole de force, discipline et élégance —,
                    Kaizen Club accompagne chaque membre dans son évolution personnelle.
                </p>
            </div>
        </div>

        <!-- ACTIVITÉS -->
        <div class="text-center mb-4" data-aos="fade-up">
            <h2 class="fw-bold hero-title">Nos Activités</h2>
            <p class="hero-text">
                Des activités variées pour développer le corps et l’esprit
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card-activity text-center">
                    <div class="card-icon">
                        <i class="fas fa-horse"></i>
                    </div>
                    <div class="card-body">
                        <h5>Équitation</h5>
                        <p>Apprendre la discipline, la confiance et le respect à travers le contact avec le cheval.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-activity text-center">
                    <div class="card-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <div class="card-body">
                        <h5>Activités Sportives</h5>
                        <p>Développement physique, coordination et esprit d’équipe à travers des activités adaptées aux jeunes.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-activity text-center">
                    <div class="card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-body">
                        <h5>Bien-être & Discipline</h5>
                        <p>Des séances pour renforcer la confiance en soi, la concentration et le bien-être mental.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- CTA -->
        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('login') }}" class="btn btn-gold btn-lg">
                Rejoindre Kaizen Club
            </a>
        </div>

    </div>
</section>

@endsection

@section('styles')
<style>
/* ================= HERO ================= */
.hero-kaizen {
    position: relative;
    height: 100vh;
    background: linear-gradient(135deg, #2b1d14, #5a3d8a, #2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    overflow: hidden;
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
    background: rgba(0,0,0,0.4);
    z-index: 1;
}

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

.horse-svg {
    width: 160px;
    height: 160px;
    fill: none;
    stroke: #d4af37;
    stroke-width: 4;
    animation: draw 3s ease forwards;
}

@keyframes draw {
    from { stroke-dasharray: 600; stroke-dashoffset: 600; }
    to { stroke-dashoffset: 0; }
}

.letter-k {
    fill: #d4af37;
    font-size: 64px;
    font-weight: 800;
}

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

.founder-icon {
    font-size: 120px;
    color: #d4af37;
}

.card-activity {
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s;
    background: white;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
}

.card-activity:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.2);
}

.card-icon {
    width: 80px;
    height: 80px;
    margin: 30px auto 20px;
    background: linear-gradient(135deg, #2b1d14, #5a3d8a);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

.card-activity h5 {
    font-weight: 600;
    margin-bottom: 15px;
}

.card-activity p {
    color: #64748b;
    margin-bottom: 0;
}

@media (max-width:768px){
    .hero-title{ font-size:2.4rem;}
}
</style>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration:1200, once:true });
</script>
@endsection
