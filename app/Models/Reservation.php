<?php

namespace App\Models;

use App\Enums\ReservationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date',
        'guests',
        'notes',
        'status',
        'confirmation_code',
        'admin_notes',
    ];

    protected $casts = [
        'date' => 'date',
        'status' => ReservationStatus::class,
    ];
}
