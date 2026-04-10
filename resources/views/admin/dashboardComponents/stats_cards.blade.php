<div class="row g-4 mb-4">
    {{-- Réservations --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Réservations</h6>
                    <h4 class="fw-bold mb-0">{{ $totalReservations ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Terrains --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-success bg-opacity-10 text-success rounded-circle p-3">
                    <i class="bi bi-map fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Terrains</h6>
                    <h4 class="fw-bold mb-0">{{ $totalTerrains ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Clients --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Clients</h6>
                    <h4 class="fw-bold mb-0">{{ $totalClients ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenus --}}
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-danger bg-opacity-10 text-danger rounded-circle p-3">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Revenus</h6>
                    <h4 class="fw-bold mb-0">{{ number_format($totalRevenus ?? 0, 0, ',', ' ') }} DH</h4>
                </div>
            </div>
        </div>
    </div>
</div>