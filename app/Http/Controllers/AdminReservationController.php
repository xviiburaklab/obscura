<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Actions\Reservations\ChangeReservationStatusAction;
use App\Enums\ReservationStatus;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('date', 'desc')->paginate(20);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation, ChangeReservationStatusAction $action)
    {
        $request->validate(['status' => 'required|string']);
        $status = ReservationStatus::tryFrom($request->input('status'));
        
        if ($status) {
            $action->execute($reservation, $status);
        }
        
        return back()->with('success', 'Reservation status updated.');
    }
    
    public function updateNotes(Request $request, Reservation $reservation)
    {
        $request->validate(['admin_notes' => 'nullable|string|max:2000']);
        $reservation->update(['admin_notes' => $request->input('admin_notes')]);
        return back()->with('success', 'Notes updated.');
    }
}
