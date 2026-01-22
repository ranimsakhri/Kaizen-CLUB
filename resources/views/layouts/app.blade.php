<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kaizen Club')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --mauve-dark:   #1a0033;
            --mauve:        #240046;
            --gold:         #d4af37;
            --text:         #f8fafc;
            --text-soft:    rgba(248,250,252,0.84);
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-weight: 300;
            background: var(--mauve);
            color: var(--text);
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Dancing Script', cursive;
            font-weight: 400;
            color: var(--text);
        }

        /* NAVBAR ultra transparente + fine */
        .navbar {
            background: rgba(36, 0, 70, 0.22) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.08);
            padding: 0.75rem 0;
            min-height: 58px;
            transition: all 0.4s ease;
        }

        .navbar.scrolled {
            background: rgba(36, 0, 70, 0.68) !important;
            backdrop-filter: blur(14px);
            border-bottom-color: rgba(212, 175, 55, 0.14);
        }

        .navbar-brand {
            font-family: 'Dancing Script', cursive;
            font-size: 2.35rem;           /* taille élégante mais pas énorme */
            font-weight: 500;
            color: var(--gold) !important;
            letter-spacing: -1.4px;       /* même style que ton hero */
            line-height: 1;
            padding: 0.1rem 0;
        }

        .nav-link {
            font-size: 0.97rem;
            font-weight: 400;
            color: var(--text-soft) !important;
            padding: 0.4rem 0.9rem !important;
            transition: all 0.28s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--gold) !important;
            transform: translateY(-1px);
        }

        .btn-kaizen, .btn-outline-kaizen {
            font-size: 0.94rem;
            padding: 0.5rem 1.3rem;
            border-radius: 999px;
        }

        .btn-kaizen {
            background: var(--gold);
            color: #0e0e1a;
            border: none;
        }

        .btn-kaizen:hover {
            background: #3a0ca3;
            color: white;
        }

        .btn-outline-kaizen {
            border: 1.4px solid var(--gold);
            color: var(--gold);
        }

        .btn-outline-kaizen:hover {
            background: var(--gold);
            color: #0e0e1a;
        }

        /* Sections plus fines et légères */
        .content-section {
            background: rgba(36,0,70,0.14);
            border: 1px solid rgba(212,175,55,0.05);
            border-radius: 14px;
            margin: 2.5rem auto;
            padding: 2.4rem 1.8rem;
            max-width: 960px;
        }

        .section-title {
            font-size: 3.2rem;
            margin-bottom: 0.9rem;
            text-align: center;
        }

        .section-subtitle {
            font-size: 1.1rem;
            letter-spacing: 3.5px;
            text-transform: uppercase;
            color: rgba(248,250,252,0.68);
            text-align: center;
            margin-bottom: 2.2rem;
        }

        /* Cartes très fines */
        .activity-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 12px;
            padding: 1.6rem 1.3rem;
            min-height: 200px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            transform: translateY(-8px);
            background: rgba(255,255,255,0.06);
        }

        .activity-icon {
            font-size: 2.6rem;
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .activity-card h5 {
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
        }

        .activity-card p {
            font-size: 0.96rem;
            color: rgba(248,250,252,0.75);
        }

        /* Footer discret */
        footer {
            background: rgba(36,0,70,0.75);
            border-top: 1px solid rgba(212,175,55,0.07);
            padding: 2.2rem 0 1.6rem;
            color: rgba(248,250,252,0.7);
            font-size: 0.9rem;
        }

        footer a {
            color: var(--gold);
            font-size: 1.25rem;
            margin: 0 0.8rem;
        }

        footer a:hover {
            color: #f5d76e;
        }
    </style>

    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-xl">
            <a class="navbar-brand" href="/">Kaizen Club</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('activiteSportif.index') }}">Activités</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('horaire.index') }}">Horaires</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('produit.index') }}">Café</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('Reservation.index') }}">Réservations</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('commandes.index') }}">Commandes</a></li>
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Utilisateurs</a></li>
                        @endif
                        <li class="nav-item ms-2">
                            <form action="{{ route('logout') }}" method="POST">@csrf
                                <button class="btn btn-outline-kaizen btn-sm">Déconnexion</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" class="btn btn-kaizen btn-sm">Connexion</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <script>
        window.addEventListener('scroll', () => {
            document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 40);
        });
    </script>

    @yield('content')

    <footer class="text-center">
        <div class="container-xl">
            <p class="mb-2">© {{ date('Y') }} Kaizen Club – Grandir • Apprendre • Progresser</p>
            <div>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 900, once: true });
    </script>

    @yield('scripts')
</body>
</html>
