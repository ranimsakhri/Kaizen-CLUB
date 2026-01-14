<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kaizen Club - Excellence Sportive')</title>
    <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Leaflet JS (mettre avant la fin de body) -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2563eb;
            --secondary: #f59e0b;
            --success: #10b981;
            --danger: #ef4444;
            --dark: #1e293b;
            --light: #f8fafc;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        .hero-section {
            padding: 100px 0;
            color: white;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .hero-section p {
            font-size: 1.3rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        .card-activity {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s;
            background: white;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            height: 100%;
        }

        .card-activity:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .card-activity .card-icon {
            width: 80px;
            height: 80px;
            margin: 30px auto 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        }

        .card-activity .card-body {
            padding: 20px 30px 30px;
        }

        .card-activity h5 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .card-activity p {
            color: #64748b;
            margin-bottom: 20px;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .content-wrapper {
            background: white;
            border-radius: 30px;
            padding: 40px;
            margin: 40px 0;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge-custom {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        footer {
            background: rgba(0, 0, 0, 0.2);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 12px 20px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.1);
        }

        .alert {
            border-radius: 15px;
            border: none;
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

                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="fas fa-home me-1"></i>Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('activiteSportif.index') }}">
                        <i class="fas fa-running me-1"></i>Activités
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('horaire.index') }}">
                        <i class="fas fa-clock me-1"></i>Horaires
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produit.index') }}">
                        <i class="fas fa-coffee me-1"></i>Café
                    </a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Reservation.index') }}">
                            <i class="fas fa-calendar-check me-1"></i>Réservations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('commandes.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i>Commandes
                        </a>
                    </li>

                    <li class="nav-item">
                        @auth
@if(auth()->user()->role === 'admin')
    <a href="{{ route('users.index') }}">
        <i class="fas fa-users"></i>
        Utilisateurs
    </a>
@endif
@endauth

                    </li>

                    <!-- Logout -->
                    <li class="nav-item ms-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i>Connexion
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>

    @yield('content')

    <!-- Footer -->
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
    @yield('scripts')
</body>
</html>
