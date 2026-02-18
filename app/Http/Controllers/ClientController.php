<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        return view('client.acceuil');
    }
    public function aboutPage(){
        return view('client.apropos');
    }
    public function reservationPage(){
        $terrains=Terrain::where('statut','=','disponible')->get();
        return view('client.terrains',compact('terrains'));
    }
}
