@extends('layouts.app')

@section('title', 'Produits - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary">
                    <i class="fas fa-coffee me-2"></i> Menu Café
                </h2>
                <p class="text-muted mb-0">Découvrez nos produits disponibles</p>
            </div>

            {{-- Bouton AJOUT : ADMIN SEULEMENT --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('produit.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Ajouter un produit
                </a>
            @endif
        </div>

        {{-- Message succès --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Recherche --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un produit...">
            </div>
        </div>

        {{-- Menu par catégories --}}
        @foreach($categories as $categorie)
            @if($categorie->produits->isNotEmpty())
                <h3 class="fw-bold mt-4 mb-3" style="color: var(--primary);">
                    {!! $categorie->icone !!} {{ $categorie->nom }}
                </h3>

                <div class="row g-4 mb-4" id="produitsCards">
                    @foreach($categorie->produits as $produit)
                        <div class="col-md-6 col-lg-4 produit-card" data-nom="{{ strtolower($produit->nom) }}">
                            <div class="card h-100 text-center p-4 shadow-sm">

                                <div class="mb-3">
                                    <i class="fas fa-coffee fa-3x text-primary"></i>
                                </div>

                                <h5 class="fw-bold">{{ $produit->nom }}</h5>
                                <h4 class="text-success fw-bold">{{ number_format($produit->prix, 2) }} DT</h4>

                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    {{-- Détails : tous --}}
                                    <a href="{{ route('produit.show', $produit->id) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i> Détails
                                    </a>

                                    {{-- Actions admin --}}
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('produit.edit', $produit->id) }}" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('produit.destroy', $produit->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer ce produit ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll('.produit-card').forEach(card => {
            card.style.display = card.dataset.nom.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection
