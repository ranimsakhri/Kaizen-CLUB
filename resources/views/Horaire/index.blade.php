@extends('layouts.app')

@section('title', 'Horaires - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: var(--primary);">
                    <i class="fas fa-clock me-2"></i>Horaires
                </h2>
                <p class="text-muted mb-0">Gérez tous les horaires disponibles</p>
            </div>
            <a href="{{ route('horaire.create') }}" class="btn btn-primary-custom btn-custom">
                <i class="fas fa-plus me-2"></i>Ajouter un horaire
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($horaires->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucun horaire disponible</h4>
                <p class="text-muted">Commencez par ajouter votre premier horaire</p>
            </div>
        @else
            <!-- Vue en cartes -->
            <div class="row g-4 mb-4" id="horairesCards">
                @foreach($horaires as $horaire)
                <div class="col-md-6 col-lg-4 horaire-card" data-date="{{ $horaire->date->format('Y-m-d') }}">
                    <div class="card h-100 text-center p-3">
                        <div class="mb-2">
                            <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">{{ $horaire->date->format('d/m/Y') }}</h5>
                        <p class="text-muted mb-1">
                            <i class="fas fa-clock me-1"></i> {{ $horaire->heure_debut }} - {{ $horaire->heure_fin }}
                        </p>
                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <a href="{{ route('horaire.edit', $horaire->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('horaire.destroy', $horaire->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet horaire ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Vue tableau -->
            <div class="table-responsive mt-5">
                <h4 class="mb-3">Vue Administrative</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure de début</th>
                            <th>Heure de fin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horaires as $horaire)
                        <tr>
                            <td class="fw-bold">{{ $horaire->date->format('d/m/Y') }}</td>
                            <td>{{ $horaire->heure_debut }}</td>
                            <td>{{ $horaire->heure_fin }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('horaire.edit', $horaire->id) }}" class="btn btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('horaire.destroy', $horaire->id) }}" method="POST" style="display:inline;">
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

@section('scripts')
<script>
    // Recherche dynamique par date
    const searchInput = document.createElement('input');
    // (optionnel : tu peux ajouter un filtre par date ici si nécessaire)
</script>
@endsection
