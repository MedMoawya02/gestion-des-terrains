@extends('layout.layout')

<style>
    .pagination .page-item .page-link {
    border-radius: 0.5rem;
    margin: 0 2px;
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}
</style>
@section('title', 'Tous les Terrains')

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-building text-primary me-2"></i>
            Tous les Terrains
        </h2>
        <a href="{{ route('createTerrain') }}" class="btn btn-primary rounded-3">
            <i class="bi bi-plus-circle me-1"></i>
            Ajouter Terrain
        </a>
    </div>

    <!-- Barre de recherche et filtres -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <input type="text" class="form-control rounded-3" placeholder="Rechercher par nom ou adresse...">
        </div>
        <div class="col-md-3">
            <select class="form-select rounded-3">
                <option value="">Tous les types</option>
                <option value="7vs7">7 vs 7</option>
                <option value="11vs11">11 vs 11</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select rounded-3">
                <option value="">Tous les statuts</option>
                <option value="disponible">Disponible</option>
                <option value="En maintenance">Maintenance</option>
            </select>
        </div>
    </div>

    <!-- Grid de cartes terrains -->
    <div class="row g-4">

        @forelse($terrains as $terrain)
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                    <!-- Image (placeholder pour test) -->
                    <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55"
                         class="card-img-top"
                         style="height:180px; object-fit:cover;">

                    <div class="card-body">

                        <h5 class="fw-bold mb-2">{{ $terrain->nom }}</h5>

                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt me-1"></i>
                            {{ $terrain->adresse }}
                        </p>

                        <p class="mb-2">
                            <i class="bi bi-dribbble text-success me-1"></i>
                            {{ $terrain->type }}
                        </p>

                        <p class="fw-semibold mb-3">
                            <i class="bi bi-cash-coin text-warning me-1"></i>
                            {{ $terrain->prix_par_heure }} MAD / heure
                        </p>

                        <div class="d-flex justify-content-between align-items-center">

                            @if($terrain->statut == 'disponible')
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i>
                                    Disponible
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-tools"></i>
                                    Maintenance
                                </span>
                            @endif

                            <div>
                                <a href="#" 
                                   class="btn btn-sm btn-outline-dark rounded-3 me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="#" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center rounded-3">
                    <i class="bi bi-info-circle"></i> Aucun terrain trouvé.
                </div>
            </div>
        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $terrains->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
