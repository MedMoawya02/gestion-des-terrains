<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
     use HasFactory;
    protected $fillable = [
        'nom',
        'type',
        'adresse',
        'prix_par_heure',
        'statut',
    ];
}
