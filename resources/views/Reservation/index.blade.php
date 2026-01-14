@extends('layouts.app')

@section('title', 'Liste des Réservations - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: var(--primary);">
                    <i class="fas fa-calendar-check me-2"></i>Réservations
                </h2>
                <p class="text-muted mb-0">Toutes les réservations enregistrées</p>
            </div>
            <!-- Si tu veux créer une réservation pour une activité spécifique, passe l'ID -->
            @if($reservations->isNotEmpty())
           <a href="{{ route('Reservation.create', ['activite_id' => $reservations->first()->activite_sportif_id]) }}" class="btn btn-primary-custom btn-custom">
    <i class="fas fa-plus me-2"></i>Ajouter une réservation
</a>

            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($reservations->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune réservation disponible</h4>
                <p class="text-muted">Commencez par ajouter votre première réservation depuis une activité</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Activité</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $reservation->activiteSportif->nom ?? 'N/A' }} ({{ $reservation->activiteSportif->type ?? '' }})</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $color = match($reservation->statut) {
                                        'en attente' => 'warning',
                                        'confirmée' => 'success',
                                        'annulée' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <span class="badge bg-{{ $color }}">{{ ucfirst($reservation->statut) }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('reservation.show', $reservation->id) }}" class="btn btn-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
