<div class="card shadow-sm border-0 rounded-4 h-100">
    <div class="card-body">
        <h5 class="fw-bold mb-4">Dernières Activités</h5>
        <div class="timeline">
            @forelse($recentReservations as $res)
                <div class="d-flex mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded p-2 me-3 h-100">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                    <div>
                        <p class="mb-0 fw-bold">Réservation de {{ $res->user->name ?? 'Client' }}</p>
                        <small class="text-muted d-block">
                            {{ $res->terrain->nom ?? 'Terrain' }} - {{ $res->heure_debut }}
                        </small>
                        <small class="text-primary fw-semibold">
                            {{ $res->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <p class="text-muted italic">Aucune activité récente</p>
                </div>
            @endforelse
        </div>

        <a href="{{ route('historique') }}"
            class="btn btn-outline-primary btn-sm w-100 rounded-pill mt-2">
            Voir tout l'historique
        </a>
    </div>
</div>