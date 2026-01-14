@extends('layouts.app')

@section('title', 'Modifier la Réservation - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <h2 class="fw-bold mb-3" style="color: var(--primary);">
            <i class="fas fa-edit me-2"></i>Modifier la Réservation pour {{ $reservation->activiteSportif->nom }}
        </h2>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('Reservation.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Date de la réservation *</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $reservation->date) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Statut *</label>
                <select name="statut" class="form-select" required>
                    <option value="en attente" {{ old('statut', $reservation->statut)=='en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmée" {{ old('statut', $reservation->statut)=='confirmée' ? 'selected' : '' }}>Confirmée</option>
                    <option value="annulée" {{ old('statut', $reservation->statut)=='annulée' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-2"></i>Mettre à jour
            </button>
            <a href="{{ route('Reservation.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
