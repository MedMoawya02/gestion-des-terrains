<?php
namespace App\Repositories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Terrain;
use App\Interfaces\DashboardRepositoryInterface;
use DB;

class DashboardRepository implements DashboardRepositoryInterface {
    public function getMonthlyStats($year) {
        return Reservation::select(DB::raw('COUNT(id) as count'), DB::raw('MONTH(date) as month'))
            ->whereYear('date', $year)->groupBy('month')->orderBy('month')->get();
    }

    public function getCounters() {
        return [
            'totalReservations' => Reservation::count(),
            'totalClients' => User::where('role', 'client')->count(),
            'totalTerrains' => Terrain::count(),
            'totalRevenus' => Reservation::sum('prix_par_heure')
        ];
    }

    public function getRecentReservations($limit) {
        return Reservation::with(['user', 'terrain'])->orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function getReservationsHistory($search, $perPage) {
        return Reservation::with(['user', 'terrain'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })->orderBy('date', 'desc')->paginate($perPage);
    }
}