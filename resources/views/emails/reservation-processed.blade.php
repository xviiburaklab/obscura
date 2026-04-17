@extends('emails.layout')

@section('content')
    @if($reservation->status->value === 'confirmed')
        <h1>Reservation Confirmed</h1>
        <p>Dear {{ $reservation->first_name }},</p>
        <p>We are pleased to inform you that your reservation for <span class="highlight">{{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }}</span> has been <span class="highlight">Confirmed</span>.</p>
        <p>Your table will be ready for the singular seating at <span class="highlight">20:00</span>. We recommend arriving at 19:45 to begin the transition.</p>
        
        <div class="code-box">
            {{ $reservation->confirmation_code }}
        </div>
        
        <p>Please present this code upon arrival.</p>
    @elseif($reservation->status->value === 'rejected')
        <h1>Reservation Update</h1>
        <p>Dear {{ $reservation->first_name }},</p>
        <p>Regarding your request for {{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }}.</p>
        <p>We regret to inform you that we are unable to accommodate your request at this time. Our singular table has limited availability, and we must curate each evening with care.</p>
        <p>Thank you for your interest in the Obscura experience.</p>
    @elseif($reservation->status->value === 'cancelled')
        <h1>Reservation Cancelled</h1>
        <p>Dear {{ $reservation->first_name }},</p>
        <p>Your reservation for {{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }} has been officially cancelled.</p>
    @endif

    @if($reservation->admin_notes)
        <div style="margin-top: 30px; padding: 20px; border: 1px dashed #6b6358;">
            <p style="font-style: italic; font-size: 14px; margin: 0;">{{ $reservation->admin_notes }}</p>
        </div>
    @endif

    <p style="text-align: center; margin-top: 40px;">
        <a href="{{ route('reservation.status', $reservation->confirmation_code) }}" class="btn">View Details</a>
    </p>
@endsection
