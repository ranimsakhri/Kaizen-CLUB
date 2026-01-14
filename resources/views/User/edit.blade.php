@extends('layouts.app')

@section('title', 'Modifier ' . $user->name . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-edit me-2"></i>Modifier l'utilisateur
            </h2>
            <p class="text-muted mb-0">Mettez à jour les informations de l'utilisateur "{{ $user->name }}"</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</h6>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('User.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Nom -->
                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold">
                        <i class="fas fa-user me-2 text-primary"></i>Nom *
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}"
                           placeholder="Ex: Ahmed Werghmi"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">
                        <i class="fas fa-envelope me-2 text-primary"></i>Email *
                    </label>
                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}"
                           placeholder="Ex: utilisateur@example.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mot de passe -->
                <div class="col-md-6">
                    <label for="password" class="form-label fw-bold">
                        <i class="fas fa-lock me-2 text-primary"></i>Mot de passe
                        <small class="text-muted">(laisser vide si inchangé)</small>
                    </label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Nouveau mot de passe">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Rôle -->
                <div class="col-md-6">
                    <label for="role" class="form-label fw-bold">
                        <i class="fas fa-user-shield me-2 text-primary"></i>Rôle *
                    </label>
                    <select name="role"
                            id="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required>
                        <option value="">-- Sélectionner un rôle --</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-between mt-4">
                <a href="{{ route('User.index') }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-arrow-left me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-save me-2"></i>Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
