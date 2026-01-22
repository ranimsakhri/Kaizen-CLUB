@extends('layouts.app')

@section('title', 'Ajouter une Commande - Kaizen Club')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
/* ================== HERO & FOND ================== */
.activities-hero {
    min-height: 100vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
}
@keyframes gradientBG {
    0% {background-position:0% 50%;}
    50% {background-position:100% 50%;}
    100% {background-position:0% 50%;}
}

/* TITRES */
.activities-title {
    font-size: 2.4rem;
    font-weight: 800;
    color: #111827;
    letter-spacing: 0.5px;
}
.activities-subtitle {
    font-size: 1rem;
    color: #9ca3af;
    margin-top: 6px;
}

/* INPUTS */
.input-dashboard {
    border-radius: 12px;
    padding: 12px 15px;
    border: 1.5px solid #d1d5db;
    background: #ffffff;
    color: #111827;
    font-weight: 500;
}
.input-dashboard::placeholder {
    color: #6b7280;
}
.input-dashboard:focus {
    border-color: #d4af37;
    box-shadow: 0 0 0 0.18rem rgba(212,175,55,0.25);
}

/* CARDS PRODUITS */
.card-product {
    border-radius: 20px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.card-product:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(212,175,55,0.2);
}

/* BOUTONS */
.btn-gold {
    background: linear-gradient(135deg, #d4af37, #f5d76e);
    color: #111827;
    border: none;
    border-radius: 30px;
    padding: 12px 28px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(212,175,55,0.4);
}
.btn-outline-dashboard {
    color: #111827;
    border: 1px solid #d4af37;
    border-radius: 30px;
    padding: 8px 20px;
    font-weight: 500;
}
.btn-outline-dashboard:hover {
    background: rgba(212,175,55,0.1);
}

/* ALERTES */
.alert-danger {
    border-radius: 14px;
}

/* MAP */
#map { height: 300px; border-radius: 15px; }

/* TOTAL */
.total-box {
    background: #f8fafc;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

@media (max-width: 768px) {
    .activities-title { font-size: 2rem; }
}
</style>
@endsection

@section('content')
<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="mb-4 text-center">
            <h2 class="activities-title" data-aos="fade-down">
                <i class="fas fa-shopping-cart me-2"></i> Ajouter une Commande
            </h2>
            <p class="activities-subtitle" data-aos="fade-up">
                Sélectionnez vos produits et confirmez votre commande
            </p>
        </div>

        <!-- Erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-down">
                <i class="fas fa-exclamation-triangle me-2"></i>Veuillez corriger les erreurs ci-dessous.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('commandes.store') }}" method="POST" id="commandeForm" data-aos="fade-up">
            @csrf

            @php
                $selectedIds = request()->query('produit_id') ? [request()->query('produit_id')] : [];
            @endphp

            @foreach($categories as $categorie)
                @php
                    $produitsCat = $produits->where('categorie_id', $categorie->id);
                @endphp

                @if($produitsCat->isNotEmpty())
                    <h4 class="fw-bold mt-4 mb-3" style="color: #d4af37;">
                        {!! $categorie->icone !!} {{ $categorie->nom }}
                    </h4>

                    <div class="row g-4 mb-4">
                        @foreach($produitsCat as $produit)
                            @php
                                $checked = in_array($produit->id, old('produits') ? array_keys(old('produits')) : $selectedIds);
                            @endphp
                            <div class="col-md-6 col-lg-4">
                                <div class="card-product">
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
                                        <label class="form-check-label" for="produit_{{ $produit->id }}">Ajouter</label>
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

            <!-- Livraison -->
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="livraisonCheckbox" name="livraison">
                <label class="form-check-label" for="livraisonCheckbox">
                    Livraison à domicile (+8.6 DT)
                </label>
            </div>

            <div id="livraisonFields" style="display:none;">
                <label class="form-label">Adresse de livraison :</label>
                <input type="text" class="form-control mb-2 input-dashboard" name="adresse" id="adresseInput" placeholder="Votre adresse">
                <div id="map"></div>
            </div>

            <div class="total-box mt-4">
                <h4>Total : <span id="totalPrix">0.00</span> DT</h4>
                <button type="submit" class="btn btn-gold btn-lg">
                    <i class="fas fa-check me-2"></i> Confirmer la commande
                </button>
            </div>

        </form>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 1200, once: true });

// TOTAL COMMANDE
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
            const qty = parseInt(cb.closest('.card-product').querySelector('.produit-qty').value) || 1;
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

// MAP
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
