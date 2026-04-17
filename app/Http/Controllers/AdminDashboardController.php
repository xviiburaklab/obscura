<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\MenuItem;
use App\Enums\ReservationStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $thisWeekStart = Carbon::now()->startOfWeek()->toDateString();
        $thisWeekEnd = Carbon::now()->endOfWeek()->toDateString();

        $stats = [
            'today' => Reservation::where('date', $today)->count(),
            'this_week' => Reservation::whereBetween('date', [$thisWeekStart, $thisWeekEnd])->count(),
            'pending' => Reservation::where('status', ReservationStatus::PENDING)->count(),
            'total_menu' => MenuItem::count(),
        ];

        $upcomingReservations = Reservation::where('date', '>=', $today)
            ->where('status', '!=', ReservationStatus::CANCELLED)
            ->orderBy('date', 'asc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'upcomingReservations'));
    }
}
