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
                    <div class="col-md-3 mb-4 terrain-card" data-nom="{{ $terrain->nom }}"
                        data-adresse="{{ $terrain->adresse }}" data-type="{{ $terrain->type }}">
                        <div class="card border-0 shadow-sm h-100 rounded-4 hover-scale">

                            <!-- Terrain Image -->
                            <img src="{{ asset('images/soccer-sport-environment-filed.jpg') }}"
                                class="card-img-top rounded-top-4" style="height:220px; object-fit:cover;">

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column">

                                <h5 class="fw-bold">{{ $terrain->nom }}</h5>

                                <p class="text-muted mb-1">
                                    📍 {{ $terrain->adresse }}
                                </p>

                                <p class="fw-semibold text-success mb-2">
                                    💰 {{ $terrain->prix_par_heure }} DH / heure
                                </p>

                                <span class="badge bg-{{ $terrain->statut == 'disponible' ? 'success' : 'secondary' }} mb-3">
                                    {{ ucfirst($terrain->statut) }}
                                </span>

                                <a href="#" class="btn btn-success w-100 mt-auto rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#reservationModal" data-id="{{ $terrain->id }}"
                                    data-nom="{{ $terrain->nom }}">
                                    Réserver
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>




    <!-- ================= SECTION VALEUR SAAS ================= -->
    <section class="py-5">
        <div class="container">

            <div class="text-center mb-5">
                <h2 class="fw-bold">🚀 Pourquoi choisir notre plateforme ?</h2>
                <p class="text-muted">
                    Une expérience moderne pensée pour les joueurs.
                </p>
            </div>

            <div class="row text-center">

                <div class="col-md-4 mb-4">
                    <div class="p-4 feature-card rounded-4 shadow-sm h-100">
                        <div class="icon mb-3">⚡</div>
                        <h5 class="fw-bold">Réservation Instantanée</h5>
                        <p class="text-muted">
                            Choisissez votre créneau et confirmez en quelques clics.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="p-4 feature-card rounded-4 shadow-sm h-100">
                        <div class="icon mb-3">🔒</div>
                        <h5 class="fw-bold">Sécurisé & Fiable</h5>
                        <p class="text-muted">
                            Gestion intelligente des disponibilités sans conflits.
                        </p>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="p-4 feature-card rounded-4 shadow-sm h-100">
                        <div class="icon mb-3">⭐</div>
                        <h5 class="fw-bold">Qualité Premium</h5>
                        <p class="text-muted">
                            Des terrains soigneusement sélectionnés pour vous.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= MODAL RESERVATION ================= -->
    <div class="modal fade" id="reservationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">

                <form method="POST" action="#">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">
                            Réserver : <span id="terrainNom"></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Hidden terrain_id -->
                        <input type="hidden" name="terrain_id" id="terrainId">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Date</label>
                            <input type="date" name="date" class="form-control rounded-pill" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Heure début</label>
                            <select name="heure_debut" class="form-select rounded-pill" required>
                                @for($h = 8; $h <= 22; $h++)
                                    <option value="{{ $h }}:00">{{ $h }}h</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Heure fin</label>
                            <select name="heure_fin" class="form-select rounded-pill" required>
                                @for($h = 9; $h <= 23; $h++)
                                    <option value="{{ $h }}:00">{{ $h }}h</option>
                                @endfor
                            </select>
                        </div>

                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-success rounded-pill w-100">
                                Confirmer réservation
                            </button>
                        </div>

                </form>

            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let modal = document.getElementById('reservationModal');
        modal.addEventListener('show.bs.modal', function (e) {
            let buttonclicked = e.relatedTarget;
            const terrainId = buttonclicked.getAttribute('data-id');
            const terrainNom = buttonclicked.getAttribute('data-nom');
            document.getElementById('terrainId').value = terrainId;
            document.getElementById('terrainNom').textContent = terrainNom;
        })
    })
</script>