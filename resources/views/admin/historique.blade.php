@extends('layout.layout')

@section('title', 'Historique des Réservations')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="fw-bold mb-1">Historique des Réservations</h2>
                <p class="text-muted">Gérez et suivez toutes les sessions de jeu sur vos terrains</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4">
                <a href="{{ route('admin.reservations.export') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-download me-2"></i> Exporter en Excel
                </a>
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">
                <form action="{{ route('historique') }}" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Rechercher</label>
                        <input type="text" name="search" class="form-control rounded-3"
                            placeholder="Nom du client, terrain...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-uppercase text-muted">Statut</label>
                        <select name="status" class="form-select rounded-3">
                            <option value="">Tous les statuts</option>
                            <option value="confirme">Confirmé</option>
                            <option value="en_attente">En attente</option>
                            <option value="annule">Annulé</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-uppercase text-muted">Date</label>
                        <input type="date" name="date" class="form-control rounded-3">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100 rounded-3">Filtrer</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 border-0">Client</th>
                            <th class="py-3 border-0">Terrain</th>
                            <th class="py-3 border-0">Date & Heure</th>
                            <th class="py-3 border-0">Montant</th>
                            <th class="py-3 border-0">Statut</th>
                            <th class="py-3 border-0 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $res)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle me-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            {{ substr($res->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $res->user->name }}</div>
                                            <div class="text-muted small">{{ $res->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $res->terrain->nom }}</span>
                                </td>
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($res->date)->format('d M Y') }}</div>
                                    <div class="badge bg-light text-dark border fw-normal">{{ $res->heure_debut }} -
                                        {{ $res->heure_fin }}</div>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ number_format($res->prix_par_heure, 2) }} DH</span>
                                </td>
                                <td>
                                    @if($res->statut == 'confirmée')
                                        <span class="badge rounded-pill bg-success-subtle text-success px-3">Confirmé</span>
                                    @elseif($res->statut == 'en_attente')
                                        <span class="badge rounded-pill bg-warning-subtle text-warning px-3">En attente</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger-subtle text-danger px-3">Annulé</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> Détails</a>
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i
                                                        class="bi bi-x-circle me-2"></i> Annuler</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    Aucune réservation trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reservations->hasPages())
                <div class="card-footer bg-white border-0 py-3">
                    {{ $reservations->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-success-subtle {
            background-color: #d1e7dd;
        }

        .bg-warning-subtle {
            background-color: #fff3cd;
        }

        .bg-danger-subtle {
            background-color: #f8d7da;
        }

        .table thead th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            font-weight: 700;
            color: #64748b;
        }

        .avatar-sm {
            font-weight: 700;
            font-size: 0.9rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
@endsection