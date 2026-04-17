<?php

namespace App\Actions\Reservations;

use App\Enums\ReservationStatus;
use App\Mail\ReservationReceived;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class CreateReservationAction
{
    /**
     * Generate an unambiguous confirmation code.
     */
    protected function generateCode(): string
    {
        $pool = '23456789ABCDEFGHJKMNPQRSTUVWXYZ'; // Excluded: 0, O, 1, I, L
        do {
            $code = 'OBS-' . substr(str_shuffle(str_repeat($pool, 6)), 0, 6);
        } while (Reservation::where('confirmation_code', $code)->exists());

        return $code;
    }

    /**
     * @throws ValidationException
     */
    public function execute(array $data): Reservation
    {
        $date = Carbon::parse($data['date'])->format('Y-m-d');
        if (Reservation::where('date', $date)->where('status', '!=', ReservationStatus::CANCELLED)->exists()) {
            throw ValidationException::withMessages([
                'date' => 'We are sorry, this date is already booked.'
            ]);
        }

        $data['confirmation_code'] = $this->generateCode();
        $data['status'] = ReservationStatus::PENDING;

        $reservation = Reservation::create($data);

        Mail::to($reservation->email)->send(new ReservationReceived($reservation));

        return $reservation;
    }
}
