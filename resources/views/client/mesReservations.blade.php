@extends('layout.layout')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">📅 Mes Réservations</h2>

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
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $res)
                        <tr>
                            <td class="fw-bold">{{ $res->terrain->nom }}</td>
                            <td>{{ date('d/m/Y', strtotime($res->date)) }}</td>
                            <td>{{ $res->heure_debut }}h</td>
                            <td>{{ $res->terrain->prix_par_heure }} DH</td>
                            <td>
                                <span class="badge rounded-pill bg-success">Confirmé</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection