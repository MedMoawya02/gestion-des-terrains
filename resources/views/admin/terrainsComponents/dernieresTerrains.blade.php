<div class="mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">
            <i class="bi bi-clock-history text-primary me-2"></i>
            Derniers terrains créés
        </h4>

        <a href="{{ route('tousTerrain') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-grid-fill me-2"></i>
            <span>Voir tous les terrains</span>
        </a>
    </div>

    <div class="row g-4">

        @forelse($lastTerrains as $terrain)

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55" class="card-img-top"
                        style="height:200px; object-fit:cover;">
                    <div class="card-body">

                        <h5 class="fw-bold mb-2">
                            <i class="bi bi-building me-1 text-secondary"></i>
                            {{ $terrain->nom }}
                        </h5>

                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt me-1"></i>
                            {{ $terrain->adresse }}
                        </p>

                        <p class="mb-2">
                            <i class="bi bi-dribbble me-1 text-success"></i>
                            {{ $terrain->type }}
                        </p>

                        <p class="fw-semibold mb-3">
                            <i class="bi bi-cash-coin me-1 text-warning"></i>
                            {{ $terrain->prix_par_heure }} MAD / heure
                        </p>

                        @if($terrain->statut == 'disponible')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i>
                                Disponible
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-tools"></i>
                                En maintenance
                            </span>
                        @endif

                    </div>

                </div>
            </div>

        @empty

            <div class="col-12">
                <div class="alert alert-light border rounded-3 text-center">
                    <i class="bi bi-info-circle"></i>
                    Aucun terrain créé pour le moment.
                </div>
            </div>

        @endforelse

    </div>


</div>