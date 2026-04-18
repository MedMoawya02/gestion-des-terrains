@extends('layout.layout')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <h2 class="fw-bold">📅 Mes Réservations</h2>

            <form action="{{ route('mesReservations') }}" method="GET" class="d-flex gap-2">
                <input type="month" name="mois" class="form-control rounded-pill" value="{{ request('mois') }}">
                <button type="submit" class="btn btn-dark rounded-pill">Filtrer</button>
                <a href="{{ route('mesReservations') }}" class="btn btn-outline-secondary rounded-pill">Réinitialiser</a>
            </form>
        </div>
        @if($reservations->isEmpty())
            <div class="alert alert-info rounded-pill">
                Vous n'avez pas encore de réservations. <a href="{{ route('reservation') }}">Réserver maintenant</a>.
            </div>
        @else
            <div class="table-responsive shadow-sm rounded-4">
                <table class="table table-hover bg-white mb-0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Terrain</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                            <tr>
                                <td class="fw-bold">{{ $res->terrain->nom }}</td>
                                <td>{{ date('d/m/Y', strtotime($res->date)) }}</td>
                                <td>{{ $res->heure_debut }}h</td>
                                <td>{{ $res->prix_par_heure }} DH</td>
                                <td class="align-middle">
                                    @if($res->statut == 'confirmée')
                                        <span class="badge bg-success-subtle text-success border border-success">Confirmé</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger">Annulé</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($res->statut=="confirmée")
                                    
                                    <form action="{{ route('res.annuler', $res->id) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-x-circle"></i> Annuler
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end text-uppercase">Total Montant :</td>
                            <td colspan="2" class="text-success fs-5">{{ number_format($totalMontant, 2) }} DH</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif
    </div>
@endsection