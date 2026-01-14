@extends('layouts.app')

@section('title', 'Modifier ' . $activiteSportif->nom . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-edit me-2"></i>Modifier l'Activité
            </h2>
            <p class="text-muted mb-0">Mettez à jour les informations de l'activité "{{ $activiteSportif->nom }}"</p>
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

        <form action="{{ route('activiteSportif.update', $activiteSportif->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Nom -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-tag me-2 text-primary"></i>Nom de l'activité *
                    </label>
                    <input type="text"
                           name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $activiteSportif->nom) }}"
                           placeholder="Ex: Cours de natation avancé"
                           required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Type -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-list me-2 text-primary"></i>Type d'activité *
                    </label>
                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Sélectionnez un type</option>
                        <option value="Équitation" {{ old('type', $activiteSportif->type) == 'Équitation' ? 'selected' : '' }}>Équitation</option>
                        <option value="Natation" {{ old('type', $activiteSportif->type) == 'Natation' ? 'selected' : '' }}>Natation</option>
                        <option value="Danse" {{ old('type', $activiteSportif->type) == 'Danse' ? 'selected' : '' }}>Danse</option>
                        <option value="Fitness" {{ old('type', $activiteSportif->type) == 'Fitness' ? 'selected' : '' }}>Fitness</option>
                        <option value="Yoga" {{ old('type', $activiteSportif->type) == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                        <option value="Musculation" {{ old('type', $activiteSportif->type) == 'Musculation' ? 'selected' : '' }}>Musculation</option>
                        <option value="Boxe" {{ old('type', $activiteSportif->type) == 'Boxe' ? 'selected' : '' }}>Boxe</option>
                        <option value="Arts martiaux" {{ old('type', $activiteSportif->type) == 'Arts martiaux' ? 'selected' : '' }}>Arts martiaux</option>
                        <option value="Pilates" {{ old('type', $activiteSportif->type) == 'Pilates' ? 'selected' : '' }}>Pilates</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Durée -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-clock me-2 text-primary"></i>Durée (minutes) *
                    </label>
                    <input type="number"
                           name="duree"
                           class="form-control @error('duree') is-invalid @enderror"
                           value="{{ old('duree', $activiteSportif->duree) }}"
                           min="15"
                           step="15"
                           required>
                    @error('duree')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Capacité -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-users me-2 text-primary"></i>Capacité maximum *
                    </label>
                    <input type="number"
                           name="capacite"
                           class="form-control @error('capacite') is-invalid @enderror"
                           value="{{ old('capacite', $activiteSportif->capacite) }}"
                           min="1"
                           required>
                    @error('capacite')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Prix -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">
                        <i class="fas fa-money-bill-wave me-2 text-primary"></i>Prix (DT) *
                    </label>
                    <input type="number"
                           name="prix"
                           step="0.01"
                           class="form-control @error('prix') is-invalid @enderror"
                           value="{{ old('prix', $activiteSportif->prix) }}"
                           min="0"
                           required>
                    @error('prix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-between mt-4">
                <a href="{{ route('activiteSportif.show', $activiteSportif->id) }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <div class="d-flex gap-3">
                    <a href="{{ route('activiteSportif.index') }}" class="btn btn-outline-dark btn-custom">
                        <i class="fas fa-list me-2"></i>Liste
                    </a>
                    <button type="submit" class="btn btn-primary-custom btn-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
