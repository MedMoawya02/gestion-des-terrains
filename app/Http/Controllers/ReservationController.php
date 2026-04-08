<?php

namespace App\Http\Controllers;

use App\Exports\ReservationsExport;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class ReservationController extends Controller
{
    public function reservationPage(Request $request)
    {
        $terrains = Terrain::where('statut', '=', 'disponible')->get();
        $date = $request->input('date', date('Y-m-d'));
        //Onrécupure les reservations
        $reservations = Reservation::where('date', $date)->get(['terrain_id', 'heure_debut']);
        //on liste les heures occupés
        $heuresReservees = [];
        foreach ($reservations as $reser) {
            $heure = ltrim(date('G:i', strtotime($reser->heure_debut)), '0');
            $heuresReservees[$reser->terrain_id][] = $heure;
        }
        ;
        return view('client.terrains', compact('terrains', 'date', 'heuresReservees'));
    }
    public function store(ReservationRequest $reservation)
    {
        try {
            $user = auth()->user();
            $terrain = Terrain::findOrFail($reservation->terrain_id);

            Reservation::create([
                'date' => $reservation->date,
                'heure_debut' => $reservation->heure_debut,
                'prix_par_heure' => $terrain->prix_par_heure,
                'user_id' => $user->id,
                'terrain_id' => $reservation->terrain_id,
            ]);
            return redirect()->to(route('reservation') . '#terrains')
                ->with('message', 'Vous avez réservé avec succès.');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function mesReservations(Request $request)
    {
        $query = Reservation::with('terrain')->where('user_id', auth()->id());

        if ($request->has('mois') && $request->mois != '') {
            $query->whereMonth('date', date('m', strtotime($request->mois)))
                ->whereYear('date', date('Y', strtotime($request->mois)));
        }

        $reservations = $query->orderBy('date', 'desc')->get();
        $totalMontant = $reservations->sum(function ($res) {
            return $res->terrain->prix_par_heure;
        });

        return View('client.mesReservations', compact('reservations', 'totalMontant'));
    }

    public function export()
    {
        return Excel::download(new ReservationsExport, 'reservations-' . date('d-m-Y') . '.xlsx');
    }
}
