@extends('layout.layout')
<style>
    .card {
        transition: all 0.35s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .card-img-top {
        transition: transform 0.4s ease;
    }

    .card:hover .card-img-top {
        transform: scale(1.05);
    }
</style>

@section('title', 'Créer un terrain')

@section('content')

    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0"><i class="bi bi-building text-primary me-2"></i>Gestion des Terrains</h2>
                <p class="text-muted mb-0"> <i class="bi bi-plus-circle me-1"></i>Ajouter un nouveau terrain</p>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark rounded-3">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <!-- Card -->
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('ajouterTerrain') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- Nom -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> <i class="bi bi-pencil-square text-primary me-1"></i>
                                Nom du terrain</label>
                            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                                value="{{ old('nom') }}" placeholder="Ex: Terrain Central" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> <i class="bi bi-dribbble text-success me-1"></i>
                                Type</label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="7vs7" {{ old('type') == '7vs7' ? 'selected' : '' }}>7 vs 7</option>
                                <option value="11vs11" {{ old('type') == '11vs11' ? 'selected' : '' }}>11 vs 11</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Adresse -->
                        <div class="col-12">
                            <label class="form-label fw-semibold"> <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                Adresse</label>
                            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                                value="{{ old('adresse') }}" placeholder="Ex: Avenue Mohammed V" required>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> <i class="bi bi-cash-coin text-warning me-1"></i>
                                Prix par heure (MAD)</label>
                            <input type="number" name="prix_par_heure" step="0.01"
                                class="form-control @error('prix_par_heure') is-invalid @enderror"
                                value="{{ old('prix_par_heure') }}" placeholder="Ex: 300" required>
                            @error('prix_par_heure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> <i class="bi bi-activity text-info me-1"></i>
                                Statut</label>
                            <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                                <option value="disponible" {{ old('statut') == 'disponible' ? 'selected' : '' }}>
                                    Disponible
                                </option>
                                <option value="En maintenance" {{ old('statut') == 'En maintenance' ? 'selected' : '' }}>
                                    En maintenance
                                </option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Bouton -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3">
                            <i class="bi bi-check-circle"></i> Enregistrer
                        </button>
                    </div>

                </form>

            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <!-- Derniers Terrains (Premium Static Test) -->
        <div class="mt-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Derniers terrains créés
                </h4>

                <button class="btn btn-outline-primary rounded-3">
                    <a href="{{ route('tousTerrain') }}">
                        <i class="bi bi-grid"></i>
                    Voir tous les terrains
                    </a>
                    
                </button>
            </div>

             <div class="row g-4">

        @forelse($lastTerrains as $terrain)

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55"
                     class="card-img-top"
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



    </div>

@endsection