<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTerrainRequest;
use App\Models\Terrain;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
}
