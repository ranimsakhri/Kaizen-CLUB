@extends('layouts.app')

@section('title', 'Commande #' . $commande->id . ' - Kaizen Club')

@section('content')
<!-- ================= HERO ================= -->
<section class="reservations-hero position-relative mb-5">
    <div class="hero-overlay"></div>
    <div class="container text-center py-5 hero-content" data-aos="fade-up">
        <div class="logo-kaizen mb-4" data-aos="zoom-in">
            <svg viewBox="0 0 200 200" class="hero-svg">
                <path d="M100 20
                         C70 40, 50 80, 55 120
                         C60 155, 95 175, 100 180
                         C105 175, 140 155, 145 120
                         C150 80, 130 40, 100 20Z"/>
                <text x="100" y="125" text-anchor="middle" class="letter-k">K</text>
            </svg>
        </div>
        <h1 class="hero-title mb-2">Commande #{{ $commande->id }}</h1>
        <p class="hero-subtitle">Détails de la commande et statut</p>
    </div>
</section>

<div class="container my-5">
    <div class="content-wrapper">

        <div class="row g-4">
            <!-- Infos principales -->
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Informations générales</h5>

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
                        <form action="{{ route('commandes.update', $commande->id) }}" method="POST" class="mt-3">
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

            <!-- Produits -->
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Produits commandés</h5>
                    @foreach($produits as $p)
                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                            <div>{{ $p['nom'] }}</div>
                            <div>x {{ $p['quantite'] }}</div>
                            <div class="text-gold">{{ number_format($p['prix'] * $p['quantite'],2) }} DT</div>
                        </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <div>Total :</div>
                        <div class="text-gold">{{ number_format($commande->total,2) }} DT</div>
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

        <div class="d-flex gap-3 mt-4 flex-wrap">
            <a href="{{ route('commandes.index') }}" class="btn btn-outline-dashboard">
                <i class="fas fa-arrow-left me-2"></i>Retour aux commandes
            </a>
        </div>

    </div>
</div>
@endsection

@section('styles')
<style>
/* ================= HERO ================= */
.reservations-hero {
    position: relative;
    min-height: 35vh;
    background: linear-gradient(135deg, #fef9e0, #fff7e6, #f8fafc);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111827;
}
.hero-overlay { position: absolute; inset:0; background: rgba(0,0,0,0.05); z-index:1; }
.hero-content { position: relative; z-index:2; }
.hero-svg { width: 100px; height:100px; fill:none; stroke:#d4af37; stroke-width:4; animation: draw 3s ease forwards; }
.letter-k { fill:#d4af37; font-size:48px; font-weight:800; }
@keyframes draw { from { stroke-dasharray:600; stroke-dashoffset:600; } to { stroke-dashoffset:0; } }
.hero-title { font-size:2.2rem; font-weight:800; color:#d4af37; }
.hero-subtitle { color:#d4af37; letter-spacing:1.5px; }

/* ================= FORMULAIRE ================= */
.input-custom { border-radius:12px; padding:12px 15px; border:1.5px solid #d1d5db; background:#ffffff; color:#111827; font-weight:500; }
.input-custom:focus { border-color:#d4af37; box-shadow:0 0 0 0.18rem rgba(212,175,55,0.25); }

/* ================= BUTTONS ================= */
.btn-gold { background: linear-gradient(135deg,#d4af37,#f5d76e); color:#111827; border-radius:30px; font-weight:600; padding:10px 24px; transition:0.3s; }
.btn-gold:hover { transform: translateY(-2px); box-shadow:0 10px 25px rgba(212,175,55,0.4); }
.btn-outline-dashboard { color:#111827; border:1px solid #d4af37; border-radius:30px; padding:8px 20px; transition:0.3s; }
.btn-outline-dashboard:hover { background: rgba(212,175,55,0.1); }

/* CARD */
.card { border-radius: 20px; }

/* RESPONSIVE */
@media(max-width:768px){
    .hero-title{font-size:1.8rem;}
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script> AOS.init({ duration:1200, once:true }); </script>

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
                L.marker([lat, lon]).addTo(map).bindPopup("Adresse de livraison").openPopup();
            } else {
                document.getElementById('map').innerHTML = "Adresse introuvable";
            }
        });
};
</script>
@endif
@endsection
