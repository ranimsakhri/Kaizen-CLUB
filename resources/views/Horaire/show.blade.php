@extends('layouts.app')

@section('title', 'Horaire du ' . $horaire->date->format('d/m/Y') . ' - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('horaire.index') }}">Horaires</a></li>
                <li class="breadcrumb-item active">Horaire du {{ $horaire->date->format('d/m/Y') }}</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-calendar-alt fa-3x text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-3">{{ $horaire->date->format('d/m/Y') }}</h3>
                    <p class="mb-1">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        Heure de début : <strong>{{ $horaire->heure_debut }}</strong>
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-clock me-2 text-success"></i>
                        Heure de fin : <strong>{{ $horaire->heure_fin }}</strong>
                    </p>

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ route('horaire.edit', $horaire->id) }}" class="btn btn-warning btn-custom">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </a>
                        <form action="{{ route('horaire.destroy', $horaire->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet horaire ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-custom">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </form>
                        <a href="{{ route('horaire.index') }}" class="btn btn-outline-secondary btn-custom">
                            <i class="fas fa-arrow-left me-2"></i>Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
