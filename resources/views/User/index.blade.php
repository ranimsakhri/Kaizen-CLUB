@extends('layouts.app')

@section('title', 'Utilisateurs - Kaizen Club')

@section('content')
<div class="container my-5">
    <div class="content-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold" style="color: var(--primary);">
                    <i class="fas fa-users me-2"></i>Nos Utilisateurs
                </h2>
                <p class="text-muted mb-0">Gérez tous les utilisateurs de la plateforme</p>
            </div>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        + Ajouter un utilisateur
                    </a>
                @endif
            @endauth
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($users->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucun utilisateur trouvé</h4>
                <p class="text-muted">Commencez par ajouter votre premier utilisateur</p>
            </div>
        @else
            <!-- Vue en cartes -->
            <div class="row g-4 mb-4" id="usersCards">
                @foreach($users as $user)
                <div class="col-md-6 col-lg-4 user-card" data-nom="{{ strtolower($user->name) }}" data-role="{{ $user->role }}">
                    <div class="card-activity h-100 text-center">
                        <div class="card-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $user->name }}</h5>
                            <span class="badge badge-custom"
                                  style="background: {{ $user->role == 'admin' ? '#f59e0b' : '#3b82f6' }}; color: white;">
                                {{ ucfirst($user->role) }}
                            </span>

                            <div class="mt-3">
                                <p class="text-muted mb-1"><i class="fas fa-envelope me-1"></i>{{ $user->email }}</p>
                            </div>

                            @if(auth()->user()->role === 'admin')
                            <div class="d-flex gap-2 justify-content-center mt-3 flex-wrap">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Vue tableau pour admin uniquement -->
            @if(auth()->user()->role === 'admin')
            <div class="table-responsive mt-5">
                <h4 class="mb-3">Vue Administrative</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="fw-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge" style="background: {{ $user->role == 'admin' ? '#f59e0b' : '#3b82f6' }}; color: white;">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm flex-wrap">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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

        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Recherche dynamique par nom et rôle
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.createElement('input');
        searchInput.id = 'searchUser';
        searchInput.type = 'text';
        searchInput.className = 'form-control mb-3';
        searchInput.placeholder = 'Rechercher un utilisateur...';
        const contentWrapper = document.querySelector('.content-wrapper');
        contentWrapper.insertBefore(searchInput, contentWrapper.firstChild);

        searchInput.addEventListener('keyup', filterUsers);

        function filterUsers() {
            const searchValue = searchInput.value.toLowerCase();
            const cards = document.querySelectorAll('.user-card');
            cards.forEach(card => {
                const nom = card.getAttribute('data-nom');
                const role = card.getAttribute('data-role');
                if (nom.includes(searchValue) || role.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection
