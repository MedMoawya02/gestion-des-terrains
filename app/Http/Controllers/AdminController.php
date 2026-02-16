<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTerrainRequest;
use App\Models\Terrain;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function create(){
         $lastTerrains = Terrain::latest()->take(3)->get();
        return view('admin.terrains',compact('lastTerrains'));
    }
    public function store(StoreTerrainRequest $request){
        Terrain::create($request->validated());
        return redirect()->back()->with('success','Terrain créé avec succès !');
    }
    public function allTerrains(){
        $terrains=Terrain::paginate(4);
        return view('admin.tousTerrains',compact('terrains'));
    }
}
