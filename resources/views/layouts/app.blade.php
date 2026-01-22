<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kaizen Club')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f8f8f8;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: rgba(0,0,0,0.4) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: #d4af37 !important;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: #f5d76e !important;
            transform: translateY(-2px);
        }

        /* ================= HERO ================= */
        .hero-kaizen {
            position: relative;
            height: 100vh;
            background: linear-gradient(135deg, #2b1d14, #5a3d8a, #2b1d14);
            background-size: 300% 300%;
            animation: gradientMove 12s ease infinite;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #f5f5f5;
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
            margin: 15px auto 0;
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
            transition: all 0.3s;
        }

        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212,175,55,0.5);
        }

        /* ================= CONTENT ================= */
        .content-wrapper {
            background: white;
            border-radius: 30px;
            padding: 40px;
            margin: 40px 0;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
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

        footer {
            background: rgba(0, 0, 0, 0.2);
            color: white;
            padding: 30px 0;
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-dumbbell me-2"></i>Kaizen Club
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/"><i class="fas fa-home me-1"></i>Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activiteSportif.index') }}"><i class="fas fa-running me-1"></i>Activités</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('horaire.index') }}"><i class="fas fa-clock me-1"></i>Horaires</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('produit.index') }}"><i class="fas fa-coffee me-1"></i>Café</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('Reservation.index') }}"><i class="fas fa-calendar-check me-1"></i>Réservations</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('commandes.index') }}"><i class="fas fa-shopping-cart me-1"></i>Commandes</a></li>
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users me-1"></i>Utilisateurs</a></li>
                        @endif
                        <li class="nav-item ms-3">
                            <form action="{{ route('logout') }}" method="POST">@csrf
                                <button class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt me-1"></i>Déconnexion</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-gold btn-sm"><i class="fas fa-sign-in-alt me-1"></i>Connexion</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} Kaizen Club - L'excellence à chaque entraînement</p>
            <div class="mt-3">
                <a href="#" class="text-white mx-2"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white mx-2"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration:1200, once:true });
    </script>
    @yield('scripts')
</body>
</html>
