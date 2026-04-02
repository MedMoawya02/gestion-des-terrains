<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable=[
        'date',
        'heure_debut',
        'user_id',
        'terrain_id',
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Terrain(){
        return $this->belongsTo(Terrain::class);
    }
}
