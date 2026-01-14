@extends('layouts.app')

@section('title', $user->name . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utilisateurs</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Icône utilisateur -->
            <div class="col-lg-5">
                <div class="text-center">
                    <div class="card-icon mx-auto mb-4" style="width: 120px; height: 120px; font-size: 3rem;">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>

            <!-- Détails utilisateur -->
            <div class="col-lg-7">
                <div class="mb-3">
                    <span class="badge badge-custom px-4 py-2"
                          style="background: {{ $user->role == 'admin' ? '#f59e0b' : '#3b82f6' }}; color: white; font-size: 0.9rem;">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <h1 class="fw-bold mb-3" style="color: var(--primary);">{{ $user->name }}</h1>

                <!-- Email -->
                <div class="mb-4">
                    <h5 class="text-muted mb-1"><i class="fas fa-envelope me-2"></i>Email</h5>
                    <p class="fw-bold">{{ $user->email }}</p>
                </div>

                <!-- Informations supplémentaires -->
                <div class="row g-3 mb-4">
                    <!-- Ici tu peux ajouter d'autres infos si besoin -->
                    <div class="col-6">
                        <div class="p-3 border rounded-3 h-100 text-center">
                            <i class="fas fa-user-shield fa-2x text-warning mb-2"></i>
                            <div>
                                <small class="text-muted d-block">Rôle</small>
                                <strong>{{ ucfirst($user->role) }}</strong>
                            </div>
                        </div>
                    </div>
                    <!-- Exemple d'autre info si disponible -->
                    <!-- <div class="col-6">
                        ...
                    </div> -->
                </div>

                <!-- Boutons d'action -->
<div class="d-flex gap-3 flex-wrap">

    {{-- Boutons réservés à l'admin --}}
    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-custom">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>

            <form action="{{ route('users.destroy', $user->id) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-custom">
                    <i class="fas fa-trash me-2"></i>Supprimer
                </button>
            </form>
        @endif
    @endauth

    {{-- Bouton visible pour tous --}}
    @auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour à la liste</a>
    @endif
@endauth

</div>

            </div>
        </div>

        <!-- Section avantages / info complémentaire -->
        <div class="row g-4 mt-5">
            <div class="col-12">
                <h4 class="fw-bold mb-4 text-center" style="color: var(--primary);">
                    <i class="fas fa-info-circle me-2"></i>Informations complémentaires
                </h4>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    <i class="fas fa-user-clock fa-3x" style="color: var(--secondary);"></i>
                </div>
                <h6 class="fw-bold">Créé le</h6>
                <p class="text-muted small">{{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    <i class="fas fa-calendar-check fa-3x" style="color: var(--primary);"></i>
                </div>
                <h6 class="fw-bold">Dernière mise à jour</h6>
                <p class="text-muted small">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
            </div>
            <!-- Tu peux ajouter d'autres blocs si tu veux -->
        </div>
    </div>
</div>
@endsection
