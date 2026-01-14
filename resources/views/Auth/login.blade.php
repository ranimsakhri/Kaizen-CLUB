@extends('layouts.app')

@section('title', 'Connexion - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Titre -->
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-sign-in-alt me-2"></i>Connexion
            </h2>
            <p class="text-muted mb-0">
                Connectez-vous pour accéder à votre espace Kaizen Club
            </p>
        </div>

        <!-- Messages d'erreur -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h6 class="alert-heading">
                    <i class="fas fa-exclamation-triangle me-2"></i>Erreur de connexion
                </h6>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Message succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulaire de connexion -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="row g-4">

                <!-- Email -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-envelope me-2 text-primary"></i>Email *
                    </label>
                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="exemple@email.com"
                           required
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-lock me-2 text-primary"></i>Mot de passe *
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <!-- Rester connecté -->
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Rester connecté
                </label>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-user-plus me-2"></i>Créer un compte
                </a>

                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
