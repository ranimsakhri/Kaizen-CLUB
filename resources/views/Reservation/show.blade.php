@extends('layouts.app')

@section('title', 'Détails de la Réservation - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <h2 class="fw-bold mb-3" style="color: var(--primary);">
            <i class="fas fa-eye me-2"></i>Détails de la Réservation
        </h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Activité : {{ $reservation->activiteSportif->nom ?? 'N/A' }} ({{ $reservation->activiteSportif->type ?? '' }})</h5>
                <p class="card-text"><strong>Date :</strong> {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
                <p class="card-text">
                    <strong>Statut :</strong>
                    @php
                        $color = match($reservation->statut) {
                            'en attente' => 'warning',
                            'confirmée' => 'success',
                            'annulée' => 'danger',
                            default => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $color }}">{{ ucfirst($reservation->statut) }}</span>
                </p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
            <a href="{{ route('Reservation.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour
            </a>
        </div>
    </div>
</div>
@endsection
