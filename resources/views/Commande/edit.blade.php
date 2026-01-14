@extends('layouts.app')

@section('title', 'Modifier la Commande - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <div class="mb-4">
            <h2 class="fw-bold text-primary">
                <i class="fas fa-edit me-2"></i>Modifier la Commande
            </h2>
            <p class="text-muted mb-0">
                Mettez à jour les informations de la commande
            </p>
        </div>

        {{-- Erreurs --}}
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

        {{-- Formulaire --}}
        <form action="{{ route('Commande.update', $commande->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- Nom --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-user me-2 text-primary"></i>Nom *
                    </label>
                    <input type="text"
                           name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $commande->nom) }}"
                           required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Prix --}}
                <div class="col-md-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-money-bill me-2 text-primary"></i>Prix (DT) *
                    </label>
                    <input type="number"
                           name="prix"
                           step="0.01"
                           min="0"
                           class="form-control @error('prix') is-invalid @enderror"
                           value="{{ old('prix', $commande->prix) }}"
                           required>
                    @error('prix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Total --}}
                <div class="col-md-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-calculator me-2 text-primary"></i>Total (DT) *
                    </label>
                    <input type="number"
                           name="total"
                           step="0.01"
                           min="0"
                           class="form-control @error('total') is-invalid @enderror"
                           value="{{ old('total', $commande->total) }}"
                           required>
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Boutons --}}
            <div class="d-flex gap-3 justify-content-between mt-4">
                <a href="{{ route('Commande.show', $commande->id) }}"
                   class="btn btn-outline-secondary">
                    Annuler
                </a>

                <div class="d-flex gap-3">
                    <a href="{{ route('Commande.index') }}"
                       class="btn btn-outline-dark">
                        Liste
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
