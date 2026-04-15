<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-calendar-check text-primary"></i>Historique des Réservations</h2>
        <p class="text-muted">Gérez et suivez toutes les sessions de jeu sur vos terrains</p>
    </div>
    <button class="btn btn-primary rounded-pill px-4">
        <a href="{{ route('admin.reservations.export') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-download me-2"></i> Exporter en Excel
        </a>
    </button>
</div>