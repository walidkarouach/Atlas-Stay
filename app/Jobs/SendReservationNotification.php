<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Reservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendReservationNotification implements ShouldQueue
{
    use Queueable;

    public Reservation $reservation;

    /**
     * Create a new job instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::create([
            'titre' => 'Réservation confirmée',
            'message' => 'Votre réservation a été confirmée par le propriétaire.',
            'lu' => false,
            'utilisateur_id' => $this->reservation->utilisateur_id,
        ]);
    }
}