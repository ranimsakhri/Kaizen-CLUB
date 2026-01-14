@extends('layouts.app')

@section('title', 'Ajouter une Activité - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-plus-circle me-2"></i>Ajouter une Nouvelle Activité
            </h2>
            <p class="text-muted mb-0">Complétez le formulaire pour créer une nouvelle activité sportive</p>
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

        <form action="{{ route('ActiviteSportif.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Nom -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-tag me-2 text-primary"></i>Nom de l'activité *
                    </label>
                    <input type="text"
                           name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}"
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
                        <option value="Équitation" {{ old('type') == 'Équitation' ? 'selected' : '' }}>Équitation</option>
                        <option value="Natation" {{ old('type') == 'Natation' ? 'selected' : '' }}>Natation</option>
                        <option value="Danse" {{ old('type') == 'Danse' ? 'selected' : '' }}>Danse</option>
                        <option value="Fitness" {{ old('type') == 'Fitness' ? 'selected' : '' }}>Fitness</option>
                        <option value="Yoga" {{ old('type') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                        <option value="Musculation" {{ old('type') == 'Musculation' ? 'selected' : '' }}>Musculation</option>
                        <option value="Boxe" {{ old('type') == 'Boxe' ? 'selected' : '' }}>Boxe</option>
                        <option value="Arts martiaux" {{ old('type') == 'Arts martiaux' ? 'selected' : '' }}>Arts martiaux</option>
                        <option value="Pilates" {{ old('type') == 'Pilates' ? 'selected' : '' }}>Pilates</option>
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
                           value="{{ old('duree', 60) }}"
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
                           value="{{ old('capacite', 10) }}"
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
                           value="{{ old('prix', 0) }}"
                           min="0"
                           required>
                    @error('prix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('ActiviteSportif.index') }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-save me-2"></i>Enregistrer l'activité
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
