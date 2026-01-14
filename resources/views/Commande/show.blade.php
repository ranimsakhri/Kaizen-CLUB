@extends('layouts.app')

@section('title', 'Commande #' . $commande->id . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <!-- Header -->
        <div class="mb-4 text-center">
            <h2 class="fw-bold text-primary">
                <i class="fas fa-receipt me-2"></i>Commande #{{ $commande->id }}
            </h2>
            <p class="text-muted">Détails de la commande et statut</p>
        </div>

        <div class="row g-4">
            <!-- Infos principales -->
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Informations générales</h5>

                    <p><strong>Client :</strong> {{ $commande->user->name ?? '—' }}</p>
                    <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Statut :</strong>
                        <span class="badge px-3 py-2
                            @if($commande->statut == 'Validée') bg-success
                            @elseif($commande->statut == 'En attente') bg-warning
                            @else bg-danger
                            @endif">
                            {{ $commande->statut }}
                        </span>
                    </p>

                    <p><strong>Total :</strong> <span class="text-success fw-bold">{{ number_format($commande->total,2) }} DT</span></p>

                    @if(Auth::user()->role === 'admin')
                        <!-- Changer le statut -->
                        <form action="{{ route('commandes.update', $commande->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label for="statut" class="form-label">Changer le statut :</label>
                                <select name="statut" id="statut" class="form-select">
                                    <option value="En attente" @if($commande->statut == 'En attente') selected @endif>En attente</option>
                                    <option value="Validée" @if($commande->statut == 'Validée') selected @endif>Validée</option>
                                    <option value="Annulée" @if($commande->statut == 'Annulée') selected @endif>Annulée</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary-custom btn-sm">Mettre à jour le statut</button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Produits -->
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Produits commandés</h5>
                    @php
                        $produits = is_string($commande->details) ? json_decode($commande->details,true) : $commande->details;
                    @endphp
                    @foreach($produits as $p)
                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                            <div>{{ $p['nom'] }}</div>
                            <div>x {{ $p['quantite'] }}</div>
                            <div class="text-success">{{ number_format($p['prix'] * $p['quantite'],2) }} DT</div>
                        </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <div>Total :</div>
                        <div class="text-success">{{ number_format($commande->total,2) }} DT</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Livraison -->
        @if($commande->livraison && $commande->adresse)
            <div class="mt-4">
                <div class="card shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Livraison à domicile</h5>
                    <p><strong>Adresse :</strong> {{ $commande->adresse }}</p>
                    <div id="map" style="width:100%; height:350px; border-radius:15px;"></div>
                    <p class="text-muted mt-2">Temps estimé : 30-45 minutes</p>
                </div>
            </div>
        @endif

        <!-- Boutons -->
        <div class="d-flex gap-3 mt-4 flex-wrap">
            <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary btn-custom">
                <i class="fas fa-arrow-left me-2"></i>Retour aux commandes
            </a>
        </div>

    </div>
</div>
@endsection

@section('scripts')
@if($commande->livraison && $commande->adresse)
<script>
window.onload = function() {
    const adresse = "{{ $commande->adresse }}";

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(adresse)}`)
        .then(response => response.json())
        .then(data => {
            if(data.length > 0){
                const lat = data[0].lat;
                const lon = data[0].lon;

                const map = L.map('map').setView([lat, lon], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup("Adresse de livraison")
                    .openPopup();
            } else {
                document.getElementById('map').innerHTML = "Adresse introuvable";
            }
        });
};
</script>
@endif
@endsection
