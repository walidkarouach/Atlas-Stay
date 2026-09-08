<?php

namespace App\Listeners;

use App\Events\ReservationConfirmed;
use App\Jobs\SendReservationNotification;

class SendReservationConfirmation
{
    /**
     * Handle the event.
     */
    public function handle(ReservationConfirmed $event): void
    {
        SendReservationNotification::dispatch(
            $event->reservation
        );
    }
}