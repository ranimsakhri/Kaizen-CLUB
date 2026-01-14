@extends('layouts.app')

@section('title', $produit->nom . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('produit.index') }}">Produits</a></li>
                <li class="breadcrumb-item active">{{ $produit->nom }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Icône -->
            <div class="col-lg-5 text-center">
                <div class="card-icon mx-auto mb-4" style="width:120px;height:120px;font-size:3rem;">
                    <i class="fas fa-coffee"></i>
                </div>
            </div>

            <!-- Détails -->
            <div class="col-lg-7">
                <h1 class="fw-bold mb-3" style="color: var(--primary);">
                    {{ $produit->nom }}
                </h1>

                <!-- Prix -->
                <div class="mb-4">
                    <h2 class="fw-bold text-success mb-0">
                        {{ number_format($produit->prix, 2) }} DT
                    </h2>
                    <small class="text-muted">Prix du produit</small>
                </div>

                <!-- BOUTONS -->
                <div class="d-flex gap-3 flex-wrap">

                    {{-- USER : ajouter à la commande --}}
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('commandes.create', ['produit_id' => $produit->id]) }}"
                           class="btn btn-success btn-custom">
                            <i class="fas fa-cart-plus me-2"></i>
                            Ajouter à la commande
                        </a>
                    @endif

                    {{-- ADMIN : modifier / supprimer --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('produit.edit', $produit->id) }}"
                           class="btn btn-warning btn-custom">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>

                        <form action="{{ route('produit.destroy', $produit->id) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-custom">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('produit.index') }}"
                       class="btn btn-outline-secondary btn-custom">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Section info -->
        <div class="row g-4 mt-5 text-center">
            <div class="col-md-4">
                <i class="fas fa-gem fa-3x text-primary mb-3"></i>
                <h6 class="fw-bold">Qualité Supérieure</h6>
                <p class="text-muted small">Produits sélectionnés avec soin</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-truck fa-3x text-success mb-3"></i>
                <h6 class="fw-bold">Service Rapide</h6>
                <p class="text-muted small">Commande traitée rapidement</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-thumbs-up fa-3x text-warning mb-3"></i>
                <h6 class="fw-bold">Satisfaction Garantie</h6>
                <p class="text-muted small">Client au centre de nos priorités</p>
            </div>
        </div>

    </div>
</div>
@endsection
