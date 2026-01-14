@extends('layouts.app')

@section('title', 'Modifier ' . $produit->nom . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="mb-4">
            <h2 class="fw-bold" style="color: var(--primary);">
                <i class="fas fa-edit me-2"></i>Modifier le Produit
            </h2>
            <p class="text-muted mb-0">Mettez à jour les informations du produit "{{ $produit->nom }}"</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</h6>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('produit.update', $produit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Nom -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-tag me-2 text-primary"></i>Nom du produit *
                    </label>
                    <input type="text"
                           name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $produit->nom) }}"
                           placeholder="Ex: Café au lait"
                           required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Prix -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-money-bill-wave me-2 text-primary"></i>Prix (DT) *
                    </label>
                    <input type="number"
                           name="prix"
                           step="0.01"
                           class="form-control @error('prix') is-invalid @enderror"
                           value="{{ old('prix', $produit->prix) }}"
                           min="0"
                           required>
                    @error('prix')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Catégorie -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">
                        <i class="fas fa-layer-group me-2 text-primary"></i>Catégorie *
                    </label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('category_id', $produit->category_id) == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->icone }} {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-between mt-4">
                <a href="{{ route('produit.index') }}" class="btn btn-outline-secondary btn-custom">
                    <i class="fas fa-times me-2"></i>Annuler
                </a>
                <div class="d-flex gap-3">
                    <a href="{{ route('produit.index') }}" class="btn btn-outline-dark btn-custom">
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
