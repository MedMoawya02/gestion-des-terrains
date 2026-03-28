<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Terrain;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function reservationPage(Request $request){
        $terrains=Terrain::where('statut','=','disponible')->get();
        $date=$request->input('date',date('Y-m-d'));
        //Onrécupure les reservations
        $reservations=Reservation::where('date',$date)->get(['terrain_id','heure_debut']);
        //on liste les heures occupés
        $heuresReservees=[];
        foreach($reservations as $reser){
            $heure = ltrim(date('G:i', strtotime($reser->heure_debut)), '0');
            $heuresReservees[$reser->terrain_id][]=$heure;
        };
        return view('client.terrains',compact('terrains','date','heuresReservees'));
    }
    public function store(ReservationRequest $reservation){
        $user=auth()->user();
        Reservation::create([
            'date'=>$reservation->date,
            'heure_debut'=>$reservation->heure_debut,
            'user_id'=>$user->id,
            'terrain_id'=>$reservation->terrain_id,
        ]);
        return back()->with(['message'=>'Vous avez reserve avec success']);
        
    }
}
