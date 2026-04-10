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