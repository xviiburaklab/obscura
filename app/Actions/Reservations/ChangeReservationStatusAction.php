<?php

namespace App\Actions\Reservations;

use App\Enums\ReservationStatus;
use App\Mail\ReservationProcessed;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;

class ChangeReservationStatusAction
{
    public function execute(Reservation $reservation, ReservationStatus $newStatus, ?string $adminNotes = null): void
    {
        $updateData = ['status' => $newStatus];
        if ($adminNotes !== null) {
            $updateData['admin_notes'] = $adminNotes;
        }

        $reservation->update($updateData);
        $reservation->refresh();

        if (in_array($newStatus, [ReservationStatus::CONFIRMED, ReservationStatus::REJECTED, ReservationStatus::CANCELLED])) {
            Mail::to($reservation->email)->send(new ReservationProcessed($reservation));
        }
    }
}
