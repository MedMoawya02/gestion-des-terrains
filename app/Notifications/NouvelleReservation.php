<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NouvelleReservation extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    // On définit le canal "database"
    public function via($notifiable)
    {
        return ['database'];
    }

    // Ce qui sera affiché dans le menu déroulant
    public function toArray($notifiable)
    {
        return [
            'titre' => 'Nouvelle Réservation',
            'message' => 'Le terrain "' . $this->reservation->terrain->nom . '" a été réservé par ' . $this->reservation->user->name,
            'url' => route('historique'), 
            'icone' => 'bi-calendar-check-fill'
        ];
    }
}