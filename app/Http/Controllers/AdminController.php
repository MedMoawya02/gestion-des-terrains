<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTerrainRequest;
use App\Models\Reservation;
use App\Models\Terrain;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Récupérer les réservations groupées par mois pour l'année actuelle
        $reservationsStats = Reservation::select(
            DB::raw('COUNT(id) as count'),
            DB::raw('MONTH(date) as month')
        )
            ->whereYear('date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // 2. Préparer les tableaux pour Chart.js (Initialiser avec 0 pour chaque mois)
        $data = array_fill(0, 12, 0);
        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];

        foreach ($reservationsStats as $stat) {
            // month est de 1 à 12, l'index du tableau est de 0 à 11
            $data[$stat->month - 1] = $stat->count;
        }

        //Statistiques
        $totalReservations = Reservation::count();
        $totalClients = User::where('role', 'client')->count();
        $totalTerrains = Terrain::count();
        $totalRevenus = Reservation::sum('prix_par_heure');

        //derniéres reservation
        $recentReservations = Reservation::with(['user', 'terrain'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('data', 'labels', 'totalReservations', 'totalClients', 'totalTerrains', 'totalRevenus', 'recentReservations'));
    }
    public function create()
    {
        $lastTerrains = Terrain::latest()->take(3)->get();
        return view('admin.terrains', compact('lastTerrains'));
    }
    public function store(StoreTerrainRequest $request)
    {
        Terrain::create($request->validated());
        return redirect()->back()->with('success', 'Terrain créé avec succès !');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|unique:terrains,nom,' . $id,
            'adresse' => 'required',
            'type' => 'required',
            'prix_par_heure' => 'required|numeric|min:10',
            'statut' => 'required'
        ]);
        $terrain = Terrain::findOrFail($id);
        $terrain->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'type' => $request->type,
            'prix_par_heure' => $request->prix_par_heure,
            'statut' => $request->statut
        ]);
        return redirect()->back()->with('success', 'Terrain mis à jour avec succès !');
    }
    public function destroy($id)
    {
        $terrain = Terrain::findOrFail($id);
        $terrain->delete();
        return redirect()->back()->with('success', 'Terrain supprimé avec succès !');
    }
    public function allTerrains()
    {
        $terrains = Terrain::paginate(4);
        return view('admin.tousTerrains', compact('terrains'));
    }

    public function allReservation()
    {
        $reservations = Reservation::with(['user', 'terrain'])
            ->when(request('search'), function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
            })
            ->orderBy('date', 'desc')
            ->paginate(8);
            return view('admin.historique',compact('reservations'));
    }
}
