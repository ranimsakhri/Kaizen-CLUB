@extends('layouts.app')

@section('title', 'Commande #' . $commande->id . ' - Kaizen Club')

@section('content')

<section class="activities-hero">
    <div class="container py-5">

        <!-- Header -->
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="activities-title">
                <i class="fas fa-receipt me-2"></i>Commande #{{ $commande->id }}
            </h1>
            <p class="activities-subtitle mt-2">
                Détails de la commande et statut
            </p>
        </div>

        <div class="row g-4">
            <!-- Infos principales -->
            <div class="col-lg-6">
                <div class="card-dashboard shadow-lg h-100" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Informations générales</h4>

                        <p><strong>Client :</strong> {{ $commande->user->name ?? '—' }}</p>
                        <p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Statut :</strong>
                            <span class="badge px-3 py-2
                                @if($commande->statut == 'en attente') bg-warning
                                @elseif($commande->statut == 'confirmée') bg-success
                                @elseif($commande->statut == 'livrée') bg-info
                                @else bg-danger
                                @endif">
                                {{ ucfirst($commande->statut) }}
                            </span>
                        </p>

                        <p><strong>Total :</strong> <span class="text-gold fw-bold">{{ number_format($commande->total,2) }} DT</span></p>

                        @if(Auth::user()->role === 'admin')
                            <!-- Changer le statut -->
                            <form action="{{ route('commandes.update', $commande->id) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="statut" class="form-label fw-bold">Changer le statut :</label>
                                    <select name="statut" id="statut" class="form-select input-custom" required>
                                        <option value="en attente" {{ $commande->statut=='en attente'?'selected':'' }}>En attente</option>
                                        <option value="confirmée" {{ $commande->statut=='confirmée'?'selected':'' }}>Confirmée</option>
                                        <option value="livrée" {{ $commande->statut=='livrée'?'selected':'' }}>Livrée</option>
                                        <option value="annulée" {{ $commande->statut=='annulée'?'selected':'' }}>Annulée</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-gold">
                                    <i class="fas fa-save me-2"></i>Mettre à jour
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Produits -->
            <div class="col-lg-6">
                <div class="card-dashboard shadow-lg h-100" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Produits commandés</h4>
                        @foreach($produits as $p)
                            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                                <div class="fw-bold">{{ $p['nom'] }}</div>
                                <div>x {{ $p['quantite'] }}</div>
                                <div class="text-gold fw-bold">{{ number_format($p['prix'] * $p['quantite'],2) }} DT</div>
                            </div>
                        @endforeach

                        <hr class="my-4">
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <div>Total :</div>
                            <div class="text-gold">{{ number_format($commande->total,2) }} DT</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Livraison -->
        @if($commande->livraison && $commande->adresse)
            <div class="mt-5" data-aos="fade-up">
                <div class="card-dashboard shadow-lg">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Livraison à domicile</h4>
                        <p class="mb-3"><strong>Adresse :</strong> {{ $commande->adresse }}</p>
                        <div id="map" style="width:100%; height:350px; border-radius:15px;"></div>
                        <p class="text-muted mt-3">Temps estimé : 30-45 minutes</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="d-flex gap-3 mt-5 flex-wrap justify-content-center">
            <a href="{{ route('commandes.index') }}" class="btn btn-outline-gold btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Retour aux commandes
            </a>
        </div>

    </div>
</section>

@endsection

@section('styles')
<style>
/* ================== HERO ================== */
.activities-hero {
    min-height: 100vh;
    padding: 60px 0;
    background: linear-gradient(135deg, #f8fafc, #fff7e6, #fef9e0);
    background-size: 600% 600%;
    animation: gradientBG 15s ease infinite;
}
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* TITRES – TOUS EN NOIR */
.activities-title,
h1, h2, h3, h4, h5 {
    color: #111827 !important;
    font-weight: 800;
}

.activities-subtitle,
.activities-hero p,
.card-dashboard p,
.text-muted {
    color: #374151 !important;
}

/* ================== BOUTONS ================== */
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
    color: #111827;
}

.btn-outline-gold {
    border: 2px solid #d4af37;
    color: #d4af37;
    background: transparent;
    border-radius: 30px;
    padding: 10px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-outline-gold:hover {
    background: #d4af37;
    color: #111827;
}

/* ================== CARTES ================== */
.card-dashboard {
    background: white;
    border-radius: 20px;
    padding: 30px;
    color: #1e293b;
    transition: all 0.4s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
.card-dashboard:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(212,175,55,0.25);
}

/* ================== RESPONSIVE ================== */
@media (max-width: 768px) {
    .activities-title { font-size: 2.2rem; }
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, once: true });
</script>

@if($commande->livraison && $commande->adresse)
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                L.marker([lat, lon]).addTo(map).bindPopup("Adresse de livraison").openPopup();
            } else {
                document.getElementById('map').innerHTML = "<p class='text-danger'>Adresse introuvable</p>";
            }
        })
        .catch(err => {
            document.getElementById('map').innerHTML = "<p class='text-danger'>Erreur lors du chargement de la carte</p>";
        });
};
</script>
@endif
@endsection
