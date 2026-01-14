@extends('layouts.app')

@section('title', 'Commandes - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary"><i class="fas fa-shopping-cart me-2"></i>Commandes</h2>
                <p class="text-muted mb-0">Gérez vos commandes</p>
            </div>
            <a href="{{ route('commandes.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-2"></i>Nouvelle commande
            </a>
        </div>

        <!-- Aucun commande -->
        @if($commandes->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune commande trouvée</h4>
                <p class="text-muted">Ajoutez votre première commande</p>
            </div>
        @else
            @foreach($commandes as $commande)
                @php
                    $produits = is_string($commande->details) ? json_decode($commande->details, true) : $commande->details;
                @endphp

                <div class="card-activity mb-4">
                    <div class="card-icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-bold text-primary">Commande #{{ $commande->id }}</h5>
                            <span class="badge bg-success">{{ $commande->statut }}</span>
                        </div>

                        <h6 class="fw-bold mt-3">Produits :</h6>
                        <div class="row g-3">
                            @foreach($produits as $p)
                                <div class="col-12 col-md-6">
                                    <div class="card shadow-sm h-100 p-3 text-center">
                                        <h6 class="fw-bold">{{ $p['nom'] }}</h6>
                                        <p class="mb-1">Prix : {{ number_format($p['prix'], 2) }} DT</p>
                                        <p class="mb-1">Quantité : {{ $p['quantite'] }}</p>
                                        <p class="fw-bold text-success">Sous-total : {{ number_format($p['prix'] * $p['quantite'], 2) }} DT</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded-3 shadow-sm">
                            <h5>Total : {{ number_format($commande->total, 2) }} DT</h5>
                            <div class="d-flex gap-2">
                                <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-primary-custom btn-sm">
                                    <i class="fas fa-eye me-1"></i> Voir
                                </a>

                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i> Modifier
                                    </a>
                                    <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette commande ?')">
                                            <i class="fas fa-trash me-1"></i> Supprimer
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
