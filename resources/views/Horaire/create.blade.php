@extends('layouts.app')

@section('title', 'Ajouter un Horaire - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-plus-circle me-2"></i>Ajouter un Nouvel Horaire
            </h2>
            <p class="text-muted mb-0">Complétez le formulaire pour créer un nouvel horaire</p>
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

        <form action="{{ route('Horaire.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                <!-- Date -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>Date *
                    </label>
                    <input type="date"
                           name="date"
                           class="form-control @error('date') is-invalid @enderror"
                           value="{{ old('date') }}"
                           required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure de début -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-clock me-2 text-primary"></i>Heure de début *
                    </label>
                    <input type="time"
                           name="heure_debut"
                           class="form-control @error('heure_debut') is-invalid @enderror"
                           value="{{ old('heure_debut') }}"
                           required>
                    @error('heure_debut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Heure de fin -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-clock me-2 text-primary"></i>Heure de fin *
                    </label>
                    <input type="time"
                           name="heure_fin"
                           class="form-control @error('heure_fin') is-invalid @enderror"
                           value="{{ old('heure_fin') }}"
                           required>
                    @error('heure_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('Horaire.index') }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-save me-2"></i>Enregistrer l'horaire
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
