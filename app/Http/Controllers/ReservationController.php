<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function status(string $code)
    {
        $reservation = Reservation::where('confirmation_code', $code)->firstOrFail();
        
        return view('reservations.show', compact('reservation'));
    }
}
