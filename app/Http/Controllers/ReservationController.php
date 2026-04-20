<?php

namespace App\Http\Controllers;

use App\Exports\ReservationsExport;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Terrain;
use App\Models\User;
use App\Notifications\NouvelleReservation;
use Carbon\Carbon;
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
        $reservations = Reservation::where('date', $date)->where('statut', '!=', 'annule')->get(['terrain_id', 'heure_debut']);
        //on liste les heures occupés
        $heuresReservees = [];
        foreach ($reservations as $reser) {
            $heure = ltrim(date('G:i', strtotime($reser->heure_debut)), '0');
            $heuresReservees[$reser->terrain_id][] = $heure;
        }
        ;
        return view('client.terrains', compact('terrains', 'date', 'heuresReservees'));
    }
    public function store(ReservationRequest $request)
    {
        try {
            $user = auth()->user();
            $terrain = Terrain::findOrFail($request->terrain_id);

            // 1. Stocker l'instance créée dans une variable
            $dejaUserReserve = Reservation::where('user_id', $user->id)->where('date', $request->date)->where('heure_debut', $request->heure_debut)->where('statut', 'confirmée')->exists();
            if ($dejaUserReserve) {
                if ($dejaUserReserve) {
                    return redirect()->back()
                        ->with('error', 'Vous avez déjà une réservation prévue pour ce créneau horaire.');
                }
            }
            $nouvelleReservation = Reservation::create([
                'date' => $request->date,
                'heure_debut' => $request->heure_debut,
                'prix_par_heure' => $terrain->prix_par_heure,
                'user_id' => $user->id,
                'terrain_id' => $request->terrain_id,
            ]);

            // 2. Charger les relations nécessaires pour la notification
            $nouvelleReservation->load(['terrain', 'user']);

            // 3. Trouver l'admin
            $admin = User::where('role', 'admin')->first();

            // 4. Envoyer l'OBJET de la base de données (pas le Request)
            if ($admin) {
                $admin->notify(new NouvelleReservation($nouvelleReservation));
            }

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
        foreach ($reservations as $res) {
            $date = Carbon::parse($res->date . ' ' . $res->heure_debut);
            ($res->date . ' ' . $res->heure_debut);
            if ($res->statut == "confirmée" && $date->isPast()) {
                $res->statut = "terminee";
            }
        }
        $totalMontant = $reservations->where('statut', '!=', 'annule')->sum('prix_par_heure');

        return View('client.mesReservations', compact('reservations', 'totalMontant'));
    }

    public function annuler($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->update([
                'prix_par_heure' => 0,
                'statut' => 'annule',
            ]);
            return back()->with('message', 'La réservation a été annulée avec succès. Le créneau est désormais libre.');

        } catch (\Throwable $th) {
            return back()->with('error', 'Une erreur est survenue lors de l\'annulation.');
        }

    }
    public function export()
    {
        return Excel::download(new ReservationsExport, 'reservations-' . date('d-m-Y') . '.xlsx');
    }
}
