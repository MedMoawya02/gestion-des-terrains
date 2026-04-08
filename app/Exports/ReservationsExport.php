<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromCollection,WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Reservation::with(['user', 'terrain'])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Client',
            'Terrain',
            'Date',
            'Heure Début',
            'Montant (DH)',
            'Statut',
        ];
    }

    public function map($reservation): array
    {
        return [
            $reservation->id,
            $reservation->user->name,
            $reservation->terrain->nom,
            $reservation->date,
            $reservation->heure_debut,
            $reservation->prix_par_heure,
            $reservation->statut,
        ];
    }
}
