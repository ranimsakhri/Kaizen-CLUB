@extends('layouts.app')

@section('title', $activiteSportif->nom . ' - Kaizen Club')

@section('content')
@auth
    @if(auth()->user()->role === 'admin')
        <!-- ================= HERO ADMIN ================= -->
        <section class="activity-hero position-relative">
            <div class="hero-overlay"></div>
            <div class="container text-center py-5 hero-content" data-aos="fade-up">
                <div class="hero-icon mb-4 dynamic-icon">
                    @switch($activiteSportif->type)
                        @case('Équitation') <i class="fas fa-horse"></i> @break
                        @case('Natation') <i class="fas fa-swimmer"></i> @break
                        @case('Danse') <i class="fas fa-music"></i> @break
                        @case('Fitness') <i class="fas fa-dumbbell"></i> @break
                        @case('Yoga') <i class="fas fa-spa"></i> @break
                        @case('Musculation') <i class="fas fa-dumbbell"></i> @break
                        @case('Boxe') <i class="fas fa-hand-rock"></i> @break
                        @default <i class="fas fa-running"></i>
                    @endswitch
                </div>

                <h1 class="hero-title">{{ $activiteSportif->nom }}</h1>
                <p class="hero-subtitle">{{ $activiteSportif->type }} • {{ $activiteSportif->duree }} min • {{ number_format($activiteSportif->prix,2) }} DT</p>

                <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-dashboard mt-3">
                    <i class="fas fa-arrow-left me-2"></i>Retour aux activités
                </a>
            </div>
        </section>

        <!-- ================= DETAILS ADMIN ================= -->
        <section class="activity-details container my-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-7">
                    <div class="badge badge-type mb-3">{{ $activiteSportif->type }}</div>
                    <h2 class="activity-title mb-3">{{ $activiteSportif->nom }}</h2>
                    <h3 class="text-gold mb-3">{{ number_format($activiteSportif->prix,2) }} DT / séance</h3>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="info-card">
                                <i class="fas fa-clock fa-2x text-gold"></i>
                                <div>
                                    <small class="text-muted d-block">Durée</small>
                                    <strong>{{ $activiteSportif->duree }} minutes</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-card">
                                <i class="fas fa-users fa-2x text-gold"></i>
                                <div>
                                    <small class="text-muted d-block">Capacité</small>
                                    <strong>{{ $activiteSportif->capacite }} personnes</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('activiteSportif.edit', $activiteSportif->id) }}" class="btn btn-gold btn-lg">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <form action="{{ route('activiteSportif.destroy', $activiteSportif->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette activité ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-dashboard btn-lg">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(auth()->user()->role === 'user')
        <!-- ================= HERO USER ================= -->
        <section class="reservation-hero position-relative mb-5">
            <div class="hero-overlay"></div>
            <div class="container text-center hero-content py-5" data-aos="fade-up">
                <div class="hero-icon dynamic-icon mb-3">
                    @switch($activiteSportif->type)
                        @case('Équitation') <i class="fas fa-horse"></i> @break
                        @case('Natation') <i class="fas fa-swimmer"></i> @break
                        @case('Danse') <i class="fas fa-music"></i> @break
                        @case('Fitness') <i class="fas fa-dumbbell"></i> @break
                        @case('Yoga') <i class="fas fa-spa"></i> @break
                        @case('Musculation') <i class="fas fa-dumbbell"></i> @break
                        @case('Boxe') <i class="fas fa-hand-rock"></i> @break
                        @default <i class="fas fa-running"></i>
                    @endswitch
                </div>
                <h1 class="hero-title mb-2">{{ $activiteSportif->nom }}</h1>
                <p class="hero-subtitle">{{ $activiteSportif->type }} • {{ $activiteSportif->duree }} min • {{ number_format($activiteSportif->prix,2) }} DT</p>
            </div>
        </section>

        <!-- ================= DETAILS USER ================= -->
        <section class="activity-details container my-5">
            <div class="card-activity h-100 text-center shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <i class="fas fa-dumbbell fa-3x mb-3 text-gold"></i>
                        <h5 class="fw-bold text-gold">{{ $activiteSportif->nom }}</h5>
                        <p class="text-gold">Type : {{ $activiteSportif->type }}</p>
                        <p class="text-gold">Durée : {{ $activiteSportif->duree }} min</p>
                        <p class="fw-bold text-gold">Prix : {{ number_format($activiteSportif->prix,2) }} DT</p>
                        <p class="text-gold">Capacité : {{ $activiteSportif->capacite }} pers.</p>
                    </div>
                    <div class="mt-3 d-flex gap-2 justify-content-center">
                        <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-gold w-45">
                            Retour
                        </a>
                        <a href="{{ route('Reservation.create', $activiteSportif->id) }}" class="btn btn-gold w-45">
                            Réserver
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endauth
@endsection

@section('styles')
<style>
/* ================= HERO ADMIN ================= */
.activity-hero {
    position: relative;
    min-height: 50vh;
    background: linear-gradient(135deg, #fef9e0, #fff7e6, #f8fafc);
    background-size: 600% 600%;
    animation: gradientMove 15s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111827;
    text-align: center;
}
.hero-overlay { position: absolute; inset:0; background: rgba(0,0,0,0.05); z-index:1; }
.hero-content { position: relative; z-index:2; }
.hero-title { font-size: 2.8rem; font-weight: 800; color: #d4af37; }
.hero-subtitle { color: #d4af37; letter-spacing: 1.2px; }

/* ================= HERO USER ================= */
.reservation-hero {
    position: relative;
    min-height: 25vh;
    background: linear-gradient(135deg,#2b1d14,#4a3c7a,#2b1d14);
    background-size: 300% 300%;
    animation: gradientMove 12s ease infinite;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-bottom: 3rem;
    border-radius: 20px;
    color: #d4af37;
}
.reservation-hero .hero-overlay { background: rgba(0,0,0,0.4); border-radius: 20px; }

/* ================= ICONS ================= */
.dynamic-icon {
    font-size: 4rem;
    width: 130px;
    height: 130px;
    background: linear-gradient(135deg,#d4af37,#f5d76e);
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#111827;
    margin:0 auto 20px;
    transition: all 0.45s ease;
}
.dynamic-icon:hover { transform: scale(1.2) rotate(10deg); box-shadow:0 30px 65px rgba(212,175,55,0.45); }

/* ================= CARTES ================= */
.card-activity {
    border-radius: 20px;
    transition: all 0.3s ease;
    padding: 20px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(14px);
    color:#d4af37;
}
.card-activity:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(212,175,55,0.2); }

/* ================= BOUTONS ================= */
.btn-gold { background: linear-gradient(135deg,#d4af37,#f5d76e); color:#111827; border-radius:30px; font-weight:600; transition: all 0.3s ease; }
.btn-gold:hover { transform: translateY(-2px) scale(1.03); box-shadow:0 12px 30px rgba(212,175,55,0.45); }

.btn-outline-gold { border:1px solid #d4af37; color:#d4af37; border-radius:30px; transition: all 0.3s ease; }
.btn-outline-gold:hover { background:#d4af37; color:#111827; }

.w-45 { width:45%; }

@keyframes gradientMove { 0% {background-position:0% 50%;} 50%{background-position:100% 50%;} 100%{background-position:0% 50%;} }

/* RESPONSIVE */
@media(max-width:768px){ .hero-title{font-size:2.2rem;} }
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 1200, once: true });
</script>
@endsection
