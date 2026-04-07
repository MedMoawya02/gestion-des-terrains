@props(['terrain'])

<div class="col-md-3 mb-4 terrain-card" 
     data-nom="{{ $terrain->nom }}"
     data-adresse="{{ $terrain->adresse }}" 
     data-type="{{ $terrain->type }}">
    <div class="card border-0 shadow-sm h-100 rounded-4 hover-scale">
        <img src="{{ asset('images/soccer-sport-environment-filed.jpg') }}"
             class="card-img-top rounded-top-4" style="height:220px; object-fit:cover;">

        <div class="card-body d-flex flex-column">
            <h5 class="fw-bold">{{ $terrain->nom }}</h5>
            <p class="text-muted mb-1">📍 {{ $terrain->adresse }}</p>
            <p class="fw-semibold text-success mb-2">💰 {{ $terrain->prix_par_heure }} DH / heure</p>

            <span class="badge bg-{{ $terrain->statut == 'disponible' ? 'success' : 'secondary' }} mb-3">
                {{ ucfirst($terrain->statut) }}
            </span>

            <a href="#" class="btn btn-success w-100 mt-auto rounded-pill" 
               data-bs-toggle="modal"
               data-bs-target="#reservationModal" 
               data-id="{{ $terrain->id }}"
               data-nom="{{ $terrain->nom }}"
               data-prix="{{ $terrain->prix_par_heure }}">
                Réserver
            </a>
        </div>
    </div>
</div>