<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTerrainRequest;
use App\Interfaces\DashboardRepositoryInterface;
use App\Interfaces\TerrainRepositoryInterface;
use App\Models\Reservation;
use App\Models\Terrain;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $terrainRepo;
    protected $dashboardRepo;
    public function __construct(TerrainRepositoryInterface $terrainRepo, DashboardRepositoryInterface $dashboardRepo)
    {
        $this->terrainRepo = $terrainRepo;
        $this->dashboardRepo = $dashboardRepo;
    }
    public function index()
    {
        $stats = $this->dashboardRepo->getMonthlyStats(date('Y'));
        $data = array_fill(0, 12, 0);
        foreach ($stats as $stat) {
            $data[$stat->month - 1] = $stat->count;
        }

        return view('admin.dashboardComponents.dashboard', array_merge(
            ['data' => $data, 'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc']],
            $this->dashboardRepo->getCounters(),
            ['recentReservations' => $this->dashboardRepo->getRecentReservations(3)]
        ));
    }
    public function create()
    {

        $lastTerrains = $this->terrainRepo->getLatest(3);
        return view('admin.terrains', compact('lastTerrains'));
    }
    public function store(StoreTerrainRequest $request)
    {
        $this->terrainRepo->store($request->validated());
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
        $this->terrainRepo->update($id, $request->all());
        return redirect()->back()->with('success', 'Terrain mis à jour avec succès !');
    }
    public function destroy($id)
    {
        $this->terrainRepo->delete($id);
        return redirect()->back()->with('success', 'Terrain supprimé avec succès !');
    }
    public function allTerrains()
    {
        $terrains = $this->terrainRepo->getAllPaginated(4);
        return view('admin.tousTerrains', compact('terrains'));
    }

    public function allReservation()
    {
        $reservations = $this->dashboardRepo->getReservationsHistory(request('search'), 8);
        return view('admin.historiqueComponents.historique', compact('reservations'));
    }
    public function calendrier()
    {
        // Récupérer les réservations avec les relations
        $reservations = Reservation::with(['user', 'terrain'])->where('statut','!=','annule')->get();

        $events = [];

        foreach ($reservations as $res) {
            $events[] = [
                'id' => $res->id,
                'title' => $res->terrain->nom . ' (' . $res->user->name . ')',
                'start' => $res->date . 'T' . $res->heure_debut, // Format ISO8601
                'end' => $res->date . 'T' . $res->heure_fin,
                'backgroundColor' => '#ff7a00',
                'borderColor' => '#e66e00',
                'extendedProps' => [
                    'client' => $res->user->name,
                    'terrain' => $res->terrain->nom,
                    'statut' => $res->statut
                ]
            ];
        }

        return view('admin.calendrier', ['events' => $events]);
    }
}
