@extends('emails.layout')

@section('content')
    <h1>Request Received</h1>
    <p>Dear {{ $reservation->first_name }},</p>
    <p>We have received your reservation request for the evening of <span class="highlight">{{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y') }}</span>.</p>
    <p>Our team personally reviews each request to ensure the integrity of the Obscura experience. You will receive an update regarding your status within 24 hours.</p>
    
    <div class="code-box">
        {{ $reservation->confirmation_code }}
    </div>
    
    <p>You may check the status of your request at any time using the link below:</p>
    <p style="text-align: center;">
        <a href="{{ route('reservation.status', $reservation->confirmation_code) }}" class="btn">View Status</a>
    </p>
@endsection
