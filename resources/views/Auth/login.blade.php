@extends('layouts.app')

@section('title', 'Connexion - Kaizen Club')

@section('content')

<!-- ================= HERO LOGIN ================= -->
<section class="hero-login">

    <div class="hero-overlay"></div>

    <div class="login-wrapper">
        <div class="login-container text-center" data-aos="fade-up">

            <!-- LOGO SVG -->
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

            <!-- TITRES -->
            <h1 class="hero-title">Connexion</h1>
            <p class="hero-subtitle">Accédez à votre espace Kaizen Club</p>

            <!-- FORMULAIRE -->
            <div class="login-form-wrapper">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-4 text-start">
                        <label class="form-label">
                            <i class="fas fa-envelope me-2 icon-gold"></i>Adresse email
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="exemple@gmail.com"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- MOT DE PASSE -->
                    <div class="mb-4 text-start">
                        <label class="form-label">
                            <i class="fas fa-lock me-2 icon-gold"></i>Code secret
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- REMEMBER -->
                    <div class="form-check mb-4 text-start">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>

                    <!-- BOUTONS -->
                    <button type="submit" class="btn btn-primary-kaizen w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </button>

                    <a href="{{ route('register') }}" class="btn btn-outline-kaizen w-100">
                        <i class="fas fa-user-plus me-2"></i>Créer un compte
                    </a>

                </form>

            </div>
        </div>
    </div>

</section>

@endsection

{{-- ================= STYLES ================= --}}
@section('styles')
<style>

/* ================= HERO LOGIN – MAUVE UNIFIÉ ================= */
.hero-login {
    position: relative;
    min-height: 100vh;
    background: #240046;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 100px 20px 120px;   /* ← espace haut + bas pour navbar & footer */
    box-sizing: border-box;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.38);
    z-index: 1;
}

/* ================= WRAPPER CENTRÉ ================= */
.login-wrapper {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 500px;
    display: flex;
    justify-content: center;
}

/* ================= CONTAINER FORMULAIRE ================= */
.login-container {
    width: 100%;
    padding: 50px 40px;
    background: rgba(255,255,255,0.05);
    border-radius: 28px;
    backdrop-filter: blur(16px);
    border: 1px solid rgba(212,175,55,0.10);
    box-shadow: 0 40px 90px rgba(0,0,0,0.55);
}

/* ================= LOGO ================= */
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

/* ================= TITRES ================= */
.hero-title {
    font-family: 'Dancing Script', cursive;
    font-size: 3.4rem;
    font-weight: 400;
    letter-spacing: -1px;
    color: #f8fafc;
    margin-bottom: 8px;
}

.hero-subtitle {
    font-size: 1.18rem;
    font-weight: 300;
    letter-spacing: 2px;
    color: rgba(248,250,252,0.90);
    margin-bottom: 36px;
}

/* ================= FORM ================= */
.form-label {
    color: rgba(248,250,252,0.92);
    font-size: 0.95rem;
    font-weight: 500;
    margin-bottom: 8px;
}

.form-control {
    border-radius: 14px;
    padding: 14px 18px;
    border: 1.8px solid rgba(212,175,55,0.25);
    background: rgba(255,255,255,0.10);
    color: #f8fafc;
    transition: all 0.32s ease;
}

.form-control::placeholder {
    color: rgba(248,250,252,0.65);
}

.form-control:focus {
    background: rgba(255,255,255,0.18);
    border-color: #d4af37;
    box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.35);
    color: #fff;
}

.form-check-input {
    border-color: rgba(212,175,55,0.4);
}

.form-check-input:checked {
    background-color: #d4af37;
    border-color: #d4af37;
}

.form-check-label {
    font-size: 0.92rem;
    color: rgba(248,250,252,0.88);
}

/* ================= BOUTONS ================= */
.btn-primary-kaizen,
.btn-outline-kaizen {
    font-family: 'Inter', sans-serif;
    font-size: 1.15rem;
    font-weight: 500;
    padding: 14px;
    border-radius: 999px;
    transition: all 0.38s ease;
}

.btn-primary-kaizen {
    background: #d4af37;
    color: #0f0f1a;
    border: none;
    box-shadow: 0 12px 36px rgba(212,175,55,0.42);
}

.btn-primary-kaizen:hover {
    background: #3a0ca3;
    color: #f8fafc;
    transform: translateY(-6px);
    box-shadow: 0 24px 56px rgba(58,12,163,0.50);
}

.btn-outline-kaizen {
    border: 2px solid #d4af37;
    color: #d4af37;
    background: transparent;
}

.btn-outline-kaizen:hover {
    background: #d4af37;
    color: #0f0f1a;
    transform: translateY(-5px);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 576px) {
    .hero-login {
        padding: 90px 15px 110px;
    }

    .login-container {
        padding: 40px 28px;
    }

    .hero-title {
        font-size: 2.8rem;
    }

    .horse-svg {
        width: 110px;
        height: 110px;
    }

    .letter-k {
        font-size: 54px;
    }
}

@media (max-height: 680px) {
    .hero-login {
        padding-top: 80px;
        padding-bottom: 80px;
        align-items: flex-start;
    }

    .login-wrapper {
        margin-top: 40px;
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
