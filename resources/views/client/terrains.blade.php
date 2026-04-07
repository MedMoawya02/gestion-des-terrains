@extends('layout.layout')

<style>
    .hero-section {
        height: 95vh;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('/images/football-hero.jpg');
        background-size: cover;
        background-position: center;
    }

    .hero-section h1 {
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
    }

    .terrain-card {
        transition: all 0.3s ease;
    }

    .terrain-card:hover {
        transform: translateY(-8px);
    }

    .feature-card {
        transition: 0.3s;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        background: #f8f9fa;
    }

    .icon {
        font-size: 2rem;
    }

    /* section terrains */
    /* Hover animation */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-scale:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
    }

    /* Search bar styles */
    #searchInput,
    #selectSearch {
        min-width: 180px;
        padding: 0.5rem 1rem;
        border-radius: 50px !important;
    }

    /* Badge spacing */
    .badge {
        font-size: 0.85rem;
    }
</style>
@section('content')

    <!-- ================= HERO ================= -->
    <section class="hero-section text-white d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">
                ⚽ Réservez votre terrain en quelques secondes
            </h1>

            <p class="lead mb-4">
                Simple. Rapide. Professionnel.
                Trouvez le terrain parfait et jouez sans stress.
            </p>

            <a href="#terrains" class="btn btn-success btn-lg rounded-pill px-5 shadow">
                Explorer les terrains
            </a>
        </div>
    </section>
    <!-- ================= TERRAINS ================= -->
    <section id="terrains" class="py-5 bg-light">
        <div class="container">
            <!-- Title -->
            <div class="text-center mb-4">
                <h2 class="fw-bold">🏟 Nos Terrains Disponibles</h2>
                <p class="text-muted">
                    Trouvez et réservez votre terrain préféré rapidement
                </p>

                <!-- Search Bar -->
                <div class="d-flex justify-content-center mt-3 gap-2 flex-wrap">
                    <input type="text" id="searchInput" class="form-control rounded-pill"
                        placeholder="Rechercher par nom ou adresse" style="max-width: 300px;">
                    <select id="selectSearch" class="form-select rounded-pill" style="max-width: 180px;">
                        <option value="">Type de terrain</option>
                        <option value="7vs7">7vs7</option>
                        <option value="11vs11">11vs11</option>
                    </select>
                </div>
            </div>
            <!-- Terrain Cards -->
            <div class="row" id="terrainContainer">
                @foreach($terrains as $terrain)
                    @include('client.terrainsComponents.terrain-card', ['terrain' => $terrain])
                @endforeach
            </div>
        </div>
        @if(session('message'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show rounded-pill shadow-sm border-0 px-4" role="alert">
                    <span class="me-2">✅</span> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </section>
    <!-- ================= SECTION VALEUR SAAS ================= -->
    @include('client.terrainsComponents.features')
    <!-- ================= MODAL RESERVATION ================= -->
    @include('client.terrainsComponents.modal')
@endsection

@include('client.terrainsComponents.scripts')