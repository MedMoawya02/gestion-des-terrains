@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4 d-flex align-items-center justify-content-between">
    <div>
        <h2 class="fw-bold mb-0">Dashboard</h2>
        <p class="text-muted mb-0">Vue générale de la plateforme</p>
    </div>

    <!-- Notification -->
    <div class="position-relative">
        <i class="bi bi-bell fs-4 text-secondary"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            3
        </span>
    </div>
</div>


<!-- Cartes statistiques -->
<div class="row g-4 mb-4">

    <!-- Carte 1 -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-primary bg-opacity-10 text-primary rounded-circle p-3">
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Réservations</h6>
                    <h4 class="fw-bold mb-0">128</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte 2 -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-success bg-opacity-10 text-success rounded-circle p-3">
                    <i class="bi bi-map fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Terrains</h6>
                    <h4 class="fw-bold mb-0">12</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte 3 -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-warning bg-opacity-10 text-warning rounded-circle p-3">
                    <i class="bi bi-people fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Clients</h6>
                    <h4 class="fw-bold mb-0">56</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte 4 -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
                <div class="me-3 bg-danger bg-opacity-10 text-danger rounded-circle p-3">
                    <i class="bi bi-cash-stack fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Revenus</h6>
                    <h4 class="fw-bold mb-0">4 500 MAD</h4>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Section contenu bas -->
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Dernières réservations</h5>
        <p class="text-muted mb-0">
            Ici tu peux afficher les dernières réservations, un tableau, ou un graphique plus tard.
        </p>
    </div>
</div>

@endsection

