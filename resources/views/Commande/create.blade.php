@extends('layouts.app')

@section('title', 'Ajouter une Commande')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map { height: 300px; border-radius: 15px; }
</style>
@endsection

@section('content')
<div class="container my-5">
    <div class="content-wrapper">

        <div class="mb-4 text-center">
            <h2 class="fw-bold text-primary">
                <i class="fas fa-shopping-cart me-2"></i> Ajouter une Commande
            </h2>
            <p class="text-muted">Sélectionnez vos produits et confirmez la commande</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('commandes.store') }}" method="POST" id="commandeForm">
            @csrf

            @php
                $selectedIds = request()->query('produit_id') ? [request()->query('produit_id')] : [];
            @endphp

            @foreach($categories as $categorie)
                @php
                    $produitsCat = $produits->where('categorie_id', $categorie->id);
                @endphp

                @if($produitsCat->isNotEmpty())
                    <h3 class="fw-bold mt-4 mb-3" style="color: var(--primary);">
                        {!! $categorie->icone !!} {{ $categorie->nom }}
                    </h3>

                    <div class="row g-4 mb-4">
                        @foreach($produitsCat as $produit)
                            @php
                                $checked = in_array($produit->id, old('produits') ? array_keys(old('produits')) : $selectedIds);
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 shadow-sm p-3 text-center position-relative">
                                    <h5 class="fw-bold">{{ $produit->nom }}</h5>
                                    <p class="text-success fw-bold mb-2">{{ number_format($produit->prix, 2) }} DT</p>

                                    <div class="form-check mb-2">
                                        <input type="checkbox"
                                               name="produits[{{ $produit->id }}][selected]"
                                               value="1"
                                               class="form-check-input produit-checkbox"
                                               id="produit_{{ $produit->id }}"
                                               data-prix="{{ $produit->prix }}"
                                               {{ $checked ? 'checked' : '' }}>
                                        <label class="form-check-label" for="produit_{{ $produit->id }}">
                                            Ajouter
                                        </label>
                                    </div>

                                    <input type="hidden" name="produits[{{ $produit->id }}][id]" value="{{ $produit->id }}">
                                    <input type="hidden" name="produits[{{ $produit->id }}][prix]" value="{{ $produit->prix }}">

                                    <label class="form-label mt-2">Quantité</label>
                                    <input type="number"
                                           name="produits[{{ $produit->id }}][quantite]"
                                           value="{{ $checked ? old("produits.$produit->id.quantite", 1) : 1 }}"
                                           min="1"
                                           class="form-control produit-qty">
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="livraisonCheckbox" name="livraison">
                <label class="form-check-label" for="livraisonCheckbox">
                    Livraison à domicile (+8.6 DT)
                </label>
            </div>

            <div id="livraisonFields" style="display:none;">
                <label class="form-label">Adresse de livraison :</label>
                <input type="text" class="form-control mb-2" name="adresse" id="adresseInput" placeholder="Votre adresse">
                <div id="map"></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded-3 shadow-sm">
                <h4>Total : <span id="totalPrix">0.00</span> DT</h4>
                <button type="submit" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-check me-2"></i> Confirmer la commande
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const livraisonCheckbox = document.getElementById('livraisonCheckbox');
    const livraisonFields = document.getElementById('livraisonFields');
    const livraisonFee = 8.6;

    livraisonCheckbox.addEventListener('change', function() {
        livraisonFields.style.display = this.checked ? 'block' : 'none';
        updateTotal();
        if(this.checked) initMap();
    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.produit-checkbox').forEach(cb => {
            if(cb.checked) {
                const qty = parseInt(cb.closest('.card').querySelector('.produit-qty').value) || 1;
                const prix = parseFloat(cb.dataset.prix);
                total += qty * prix;
            }
        });
        if(livraisonCheckbox.checked) total += livraisonFee;
        document.getElementById('totalPrix').textContent = total.toFixed(2);
    }

    document.querySelectorAll('.produit-checkbox, .produit-qty').forEach(el => {
        el.addEventListener('change', updateTotal);
    });

    updateTotal();

    let map, marker;
    function initMap() {
        if(map) return;
        map = L.map('map').setView([36.81897, 10.16579], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        if(navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;
                map.setView([lat, lon], 15);
                marker = L.marker([lat, lon], {draggable:true}).addTo(map);
                document.getElementById('adresseInput').value = `${lat.toFixed(5)}, ${lon.toFixed(5)}`;
                marker.on('dragend', e => {
                    const p = marker.getLatLng();
                    document.getElementById('adresseInput').value = `${p.lat.toFixed(5)}, ${p.lng.toFixed(5)}`;
                });
            });
        }
    }
</script>
@endsection
