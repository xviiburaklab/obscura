<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminReservationController;
use App\Http\Controllers\AdminMenuController;

use App\Http\Controllers\AdminDashboardController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/reservation', [PublicController::class, 'storeReservation'])->name('reservation.store')->middleware('throttle:5,1'); // Custom rate limiting for reservations
Route::get('/reservations/{code}', [App\Http\Controllers\ReservationController::class, 'status'])->name('reservation.status');

// Admin Routes protected by auth middleware
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Reservations
    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [AdminReservationController::class, 'show'])->name('reservations.show');
    Route::patch('/reservations/{reservation}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.update_status');
    Route::patch('/reservations/{reservation}/notes', [AdminReservationController::class, 'updateNotes'])->name('reservations.update_notes');
    
    // Menu
    Route::resource('menu', AdminMenuController::class)->except(['show']);
});

require __DIR__.'/auth.php';
