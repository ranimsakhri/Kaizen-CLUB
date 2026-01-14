@extends('layouts.app')

@section('title', 'Inscription - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Titre -->
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-user-plus me-2"></i>Créer un compte
            </h2>
            <p class="text-muted mb-0">
                Inscrivez-vous pour rejoindre le Kaizen Club
            </p>
        </div>

        <!-- Erreurs -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h6 class="alert-heading">
                    <i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation
                </h6>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="row g-4">

                <!-- Nom -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-user me-2 text-primary"></i>Nom complet *
                    </label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Votre nom complet"
                           required
                           autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                           required>
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

                <!-- Confirmation -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-lock me-2 text-primary"></i>Confirmation *
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirmer le mot de passe"
                           required>
                </div>

            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>

                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-user-check me-2"></i>S'inscrire
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
