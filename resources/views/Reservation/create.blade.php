@extends('layouts.app')

@section('title', 'Ajouter une Réservation - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-plus-circle me-2"></i>Ajouter une Réservation pour {{ $activite->nom }}
            </h2>
            <p class="text-muted mb-0">Complétez le formulaire pour créer une réservation</p>
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

        <form action="{{ route('Reservation.store') }}" method="POST">
            @csrf

            <!-- Champ caché pour l'activité -->
            <input type="hidden" name="activite_sportif_id" value="{{ $activite->id }}">

            <div class="row g-4">
                <!-- Date -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-calendar-alt me-2 text-primary"></i>Date de réservation *
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

                <!-- Statut -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Statut *
                    </label>
                    <select name="statut" class="form-select @error('statut') is-invalid @enderror" required>
                        <option value="en attente" {{ old('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmée" {{ old('statut') == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                        <option value="annulée" {{ old('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('statut')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('activiteSportif.show', $activite->id) }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-save me-2"></i>Enregistrer la réservation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
