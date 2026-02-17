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

    /* modal style */
    .modal-content {
        animation: fadeInUp 0.3s ease;
    }

    .input-group-text {
        border-radius: 0.5rem 0 0 0.5rem;
    }

    .form-control,
    .form-select {
        border-radius: 0 0.5rem 0.5rem 0;
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(15px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
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
                <input type="text" id="searchInput" class="form-control rounded-3"
                    placeholder="Rechercher par nom ou adresse...">
            </div>
            <div class="col-md-3">
                <select class="form-select rounded-3" id="selectSearch">
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
                <div class="col-md-3 terrain-card" data-nom="{{ $terrain->nom }}" data-adresse="{{ $terrain->adresse }}"
                    data-type="{{ $terrain->type }}">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">

                        <!-- Image (placeholder pour test) -->
                        <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55" class="card-img-top"
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
                                    <a href="#" class="btn btn-sm btn-outline-dark rounded-3 me-1 editBtn"
                                        data-id="{{ $terrain->id }}" data-nom="{{ $terrain->nom }}"
                                        data-adresse="{{ $terrain->adresse }}" data-type="{{ $terrain->type }}"
                                        data-prix="{{ $terrain->prix_par_heure }}" data-statut="{{ $terrain->statut }}"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('deleteTerrain', $terrain->id)}}" method="POST" class="d-inline">
                                        @csrf
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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Modal --}}
        <div class="modal fade" id="editModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 shadow-lg border-0">

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Header -->
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">
                                <i class="bi bi-pencil-square text-primary me-2"></i>
                                Modifier le terrain
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body pt-3">

                            <!-- Nom -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nom</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-building"></i>
                                    </span>
                                    <input type="text" name="nom" id="modalNom" class="form-control"
                                        placeholder="Nom du terrain" required>
                                </div>
                            </div>

                            <!-- Adresse -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Adresse</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>
                                    <input type="text" name="adresse" id="modalAdresse" class="form-control"
                                        placeholder="Adresse complète" required>
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Type</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-dribbble"></i>
                                    </span>
                                    <select name="type" id="modalType" class="form-select" required>
                                        <option value="">Choisir</option>
                                        <option value="7vs7">7 vs 7</option>
                                        <option value="11vs11">11 vs 11</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Prix -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Prix / heure</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-cash-coin"></i>
                                    </span>
                                    <input type="number" name="prix_par_heure" id="modalPrix" class="form-control" min="10"
                                        placeholder="Prix en MAD" required>
                                </div>
                            </div>

                            <!-- Statut -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Statut</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                    <select name="statut" id="modalStatut" class="form-select" required>
                                        <option value="disponible">Disponible</option>
                                        <option value="En maintenance">En maintenance</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">
                                <i class="bi bi-check-lg me-1"></i>
                                Modifier
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let search = document.getElementById('searchInput');
        let select = document.getElementById('selectSearch');
        let terrainsCards = document.querySelectorAll('.terrain-card')
        let editbtns = document.querySelectorAll('.editbtn');
        search.addEventListener('input', (e) => {
            let query = e.target.value.toLowerCase();
            terrainsCards.forEach(card => {
                let nom = card.getAttribute('data-nom').toLowerCase();
                let adresse = card.getAttribute('data-adresse').toLowerCase();
                if (nom.includes(query) || adresse.includes(query)) {
                    card.style.display = "block";
                } else {
                    card.style.display = 'none';
                }
            })
        })
        select.addEventListener('change', function (e) {
            let query = e.target.value;
            terrainsCards.forEach(card => {
                let type = card.getAttribute('data-type');
                if (type == query || query == "") {
                    card.style.display = "block";
                } else {
                    card.style.display = 'none';
                }
            })

        })
        //Modal
        editbtns.forEach(btn => {
            btn.addEventListener('click', function () {
                let id = btn.dataset.id
                document.getElementById('modalNom').value = this.dataset.nom;
                document.getElementById('modalAdresse').value = this.dataset.adresse;
                document.getElementById('modalType').value = this.dataset.type;
                document.getElementById('modalPrix').value = this.dataset.prix;
                document.getElementById('modalStatut').value = this.dataset.statut;

                document.getElementById('editForm').action = `/modifierTerrain/${id}`;
            })

        })

    </script>
@endsection