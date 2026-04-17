<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Actions\Reservations\CreateReservationAction;
use App\Http\Requests\ReservationRequest;
use Illuminate\Validation\ValidationException;

class PublicController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::where('is_active', true)->orderBy('sort_order')->get();
        // Passing menu items grouped by course could be helpful, but we can do that in the view
        return view('home', compact('menuItems'));
    }

    public function storeReservation(ReservationRequest $request, CreateReservationAction $action)
    {
        try {
            $reservation = $action->execute($request->validated());
            
            // TODO: Send Confirmation Email here or dispatch Event
            
            return back()->with('success', 'Request received! Your confirmation code is ' . $reservation->confirmation_code);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
