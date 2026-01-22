@extends('layouts.app')

@section('title', 'Horaires - Kaizen Club')

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <div>
                <h2 class="activities-title" data-aos="fade-down">
                    <i class="fas fa-clock me-2 text-gold"></i> Horaires
                </h2>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <p class="activities-subtitle" data-aos="fade-up">
                            Gérez tous les horaires des activités sportives
                        </p>
                    @endif
                @endauth
            </div>

            <!-- Bouton Retour pour tous -->
            <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-secondary btn-sm mb-2" data-aos="zoom-in">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>

        </div>

        <!-- Activités et horaires -->
        @foreach($activites as $activite)
            <div class="card card-activity mb-4" data-aos="fade-up">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                        <h4 class="fw-bold text-gold">
                            <i class="fas fa-dumbbell me-2 text-gold"></i> {{ $activite->nom }}
                        </h4>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('horaire.create', $activite->id) }}" class="btn btn-gold btn-sm mb-2">
                                    <i class="fas fa-plus me-1"></i> Ajouter un horaire
                                </a>
                            @endif
                        @endauth
                    </div>

                    @if($activite->horaires->isEmpty())
                        <p class="text-muted">Aucun horaire pour cette activité</p>
                    @else
                        <div class="row g-3">
                            @foreach($activite->horaires as $horaire)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 text-center p-3 card-horaire">
                                        <div class="mb-2">
                                            <i class="fas fa-clock fa-2x text-gold"></i>
                                        </div>
                                        <h5>{{ $horaire->date->format('d/m/Y') }}</h5>
                                        <p>{{ $horaire->heure_debut }} - {{ $horaire->heure_fin }}</p>

                                        <!-- ACTIONS : ADMIN SEULEMENT -->
                                        @auth
                                            @if(auth()->user()->role === 'admin')
                                                <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                                                    <a href="{{ route('horaire.edit', $horaire->id) }}" class="btn btn-outline-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Modifier
                                                    </a>
                                                    <form action="{{ route('horaire.destroy', $horaire->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer cet horaire ?')">
                                                            <i class="fas fa-trash"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Message succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tableau administratif : ADMIN SEULEMENT -->
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="table-responsive mt-5" data-aos="fade-up">
                    <h4 class="mb-3 text-gold">Vue Administrative</h4>
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Activité</th>
                                <th>Date</th>
                                <th>Heure de début</th>
                                <th>Heure de fin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activites as $activite)
                                @foreach($activite->horaires as $horaire)
                                    <tr>
                                        <td>{{ $activite->nom }}</td>
                                        <td>{{ $horaire->date->format('d/m/Y') }}</td>
                                        <td>{{ $horaire->heure_debut }}</td>
                                        <td>{{ $horaire->heure_fin }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('horaire.edit', $horaire->id) }}" class="btn btn-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('horaire.destroy', $horaire->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endauth

    </div>
</section>
@endsection

@section('styles')
<style>
/* ========== FOND HERO ========== */
.activities-hero {
    min-height: 100vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
}

@keyframes gradientBG {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

/* TITRES */
.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}
.activities-subtitle {
    font-size: 1rem;
    color: #9ca3af;
    margin-top: 6px;
}

/* GOLD TEXT */
.text-gold {
    color: #d4af37 !important;
}

/* CARTES ACTIVITÉS */
.card-activity {
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.card-activity:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}
.card-horaire {
    border-radius: 16px;
    background: #ffffff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* BOUTONS */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #111827;
    border: none;
    border-radius: 30px;
    padding: 8px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.4);
}
.btn-outline-secondary {
    border-radius: 30px;
    padding: 5px 12px;
    color: #374151;
    border: 1px solid #d1d5db;
    transition: all 0.3s ease;
}
.btn-outline-secondary:hover {
    background: rgba(212,175,55,0.08);
    border-color: #d4af37;
    color: #111827;
}

.btn-outline-warning {
    border-radius: 30px;
    padding: 5px 12px;
}
.btn-outline-danger {
    border-radius: 30px;
    padding: 5px 12px;
}

/* TABLE ADMIN */
.table-hover tbody tr:hover {
    background-color: rgba(212,175,55,0.1);
}
.table-dark th {
    background: #111827;
    color: #f8fafc;
}

/* ALERTES */
.alert-success {
    border-radius: 14px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .activities-title { font-size: 2rem; }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>
@endsection
