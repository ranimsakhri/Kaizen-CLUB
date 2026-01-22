@extends('layouts.app')

@section('title', 'Utilisateurs - Kaizen Club')

@section('content')

@auth
    @if(auth()->user()->role === 'admin')
        <!-- ================= HERO ADMIN ================= -->
        <section class="activities-hero">
            <div class="container py-5 text-center">
                <h2 class="activities-title" data-aos="fade-down">
                    <i class="fas fa-users me-2"></i>Gestion des Utilisateurs
                </h2>
                <p class="activities-subtitle" data-aos="fade-up">
                    Administrateur – Consultez, modifiez ou supprimez des utilisateurs
                </p>

                <a href="{{ route('users.create') }}" class="btn btn-gold btn-lg mt-4" data-aos="fade-up">
                    + Ajouter un utilisateur
                </a>
            </div>
        </section>

        <div class="container my-5">
            @if($users->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun utilisateur trouvé</h4>
                    <p class="text-muted">Commencez par ajouter votre premier utilisateur</p>
                </div>
            @else
                <!-- Tableau Admin -->
                <div class="table-responsive">
                    <table class="table table-hover table-users">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge" style="background: {{ $user->role=='admin'?'#d4af37':'#3b82f6' }}; color:white;">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-dashboard">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-gold">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Confirmer la suppression ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    @else
        <!-- ================= HERO USER ================= -->
        <section class="reservation-hero position-relative mb-5">
            <div class="hero-overlay"></div>
            <div class="container text-center hero-content py-5" data-aos="fade-up">
                <div class="hero-icon dynamic-icon mb-3">
                    <i class="fas fa-user"></i>
                </div>
                <h1 class="hero-title mb-2">Mon Profil</h1>
                <p class="hero-subtitle">Bienvenue dans votre espace utilisateur Kaizen Club</p>
            </div>
        </section>

        <div class="container my-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card-activity h-100 text-center shadow-sm">
                        <div class="card-icon mb-3"><i class="fas fa-user-circle"></i></div>
                        <div class="card-body">
                            <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
                            <span class="badge" style="background:#3b82f6; color:white;">Utilisateur</span>
                            <p class="text-muted mt-2 mb-0"><i class="fas fa-envelope me-1"></i>{{ auth()->user()->email }}</p>
                            <div class="d-flex gap-2 justify-content-center mt-3">
                                <a href="{{ route('users.show', auth()->id()) }}" class="btn btn-outline-info"><i class="fas fa-eye"></i> Voir</a>
                                <a href="{{ route('users.edit', auth()->id()) }}" class="btn btn-outline-gold"><i class="fas fa-edit"></i> Modifier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth

@endsection

@section('styles')
<style>
/* ================= HERO ADMIN & GRADIENT ================== */
.activities-hero {
    min-height: 30vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
    text-align: center;
}
@keyframes gradientBG {
    0% { background-position:0% 50%; }
    50% { background-position:100% 50%; }
    100% { background-position:0% 50%; }
}

.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;
}
.activities-subtitle {
    font-size: 1rem;
    color: #9ca3af;
    margin-top: 6px;
}

/* TABLEAU ADMIN */
.table-users {
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}
.table-users thead { background:#111827; color:#d4af37; text-transform:uppercase; font-size:0.85rem; }
.table-users tbody tr:hover { background: rgba(212,175,55,0.08); }

/* BOUTONS */
.btn-gold {
    background: linear-gradient(135deg,#d4af37,#f5d76e);
    color:#111827;
    border-radius:30px;
    font-weight:600;
}
.btn-outline-dashboard {
    color:#111827;
    border:1px solid #d4af37;
    border-radius:30px;
}
.btn-outline-dashboard:hover { background: rgba(212,175,55,0.1); }
.btn-outline-danger { border-radius:30px; border:1px solid #ef4444; color:#ef4444; }
.btn-outline-danger:hover { background: rgba(239,68,68,0.1); }

/* RESPONSIVE */
@media (max-width:768px) {
    .activities-title { font-size:2rem; }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration:1200, once:true });
</script>
@endsection
