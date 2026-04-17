@extends('layouts.public')

@section('content')
<nav class="nav">
    <div class="container nav__inner">
        <a href="{{ route('home') }}" class="nav__logo">Obscura</a>
        <ul class="nav__links">
            <li><a href="{{ route('home') }}#philosophy">Philosophy</a></li>
            <li><a href="{{ route('home') }}#menu">Menu</a></li>
            <li><a href="{{ route('home') }}#reservation" class="text-accent">Reserve</a></li>
        </ul>
    </div>
</nav>

<section class="section hero hero--small">
    <div class="container container--narrow text-center">
        <p class="section__eyebrow reveal">Reservation Status</p>
        <h1 class="section__title reveal">{{ $reservation->confirmation_code }}</h1>
        <div class="divider reveal"></div>
    </div>
</section>

<section class="section">
    <div class="container container--narrow">
        <div class="status-card reveal">
            <div class="status-card__header">
                <span class="status-badge status-badge--{{ $reservation->status->value }}">
                    {{ ucfirst($reservation->status->value) }}
                </span>
            </div>
            
            <div class="status-card__grid">
                <div class="status-info">
                    <label>Guest</label>
                    <p>{{ $reservation->first_name }} {{ $reservation->last_name }}</p>
                </div>
                <div class="status-info">
                    <label>Date</label>
                    <p>{{ $reservation->date->format('F d, Y') }}</p>
                </div>
                <div class="status-info">
                    <label>Guests</label>
                    <p>{{ $reservation->guests }} people</p>
                </div>
                <div class="status-info">
                    <label>Time</label>
                    <p>20:00 (Standard Seating)</p>
                </div>
            </div>

            @if($reservation->admin_notes)
                <div class="status-notes reveal reveal--delay-1">
                    <label>Note from the Restaurant</label>
                    <p>{{ $reservation->admin_notes }}</p>
                </div>
            @endif

            <div class="status-footer reveal reveal--delay-2">
                @if($reservation->status->value === 'pending')
                    <p class="text-muted">Our team is currently reviewing your request. You will receive an update within 24 hours.</p>
                @elseif($reservation->status->value === 'confirmed')
                    <p class="text-accent">Your table is secured. We look forward to hosting you. Please arrive promptly at 19:45 for the 20:00 seating.</p>
                @elseif($reservation->status->value === 'rejected')
                    <p class="text-muted">We regret to inform you that we cannot accommodate your request at this time. Thank you for your interest in Obscura.</p>
                @endif
            </div>
        </div>
        
        <div class="text-center" style="margin-top: 4rem;">
            <a href="{{ route('home') }}" class="btn-link">Return to Home</a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <p class="footer__logo">Obscura</p>
        <p class="footer__copy">&copy; {{ date('Y') }} Obscura. A portfolio project.</p>
    </div>
</footer>

<style>
    .hero--small {
        min-height: 40vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--bg);
        padding-top: 100px;
    }
    
    .status-card {
        background: var(--surface);
        border: 1px solid var(--border);
        padding: 3rem;
        margin-top: -5vh;
        position: relative;
        z-index: 10;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: 1px solid currentColor;
        margin-bottom: 2rem;
    }
    
    .status-badge--pending { color: var(--gold); }
    .status-badge--confirmed { color: #4caf50; }
    .status-badge--rejected { color: #f44336; }
    .status-badge--cancelled { color: var(--muted); }
    
    .status-card__grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .status-info label {
        display: block;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--muted);
        margin-bottom: 0.5rem;
    }
    
    .status-info p {
        font-size: 1.1rem;
        margin: 0;
    }
    
    .status-notes {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border);
    }
    
    .status-notes label {
        display: block;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--gold);
        margin-bottom: 0.5rem;
    }
    
    .status-footer {
        margin-top: 3rem;
        font-style: italic;
    }

    .btn-link {
        color: var(--gold);
        text-decoration: none;
        font-size: 0.8rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border-bottom: 1px solid transparent;
        transition: border-color 0.3s ease;
    }

    .btn-link:hover {
        border-bottom-color: var(--gold);
    }

    @media (max-width: 768px) {
        .status-card__grid {
            grid-template-columns: 1fr;
        }
        .status-card {
            padding: 2rem;
        }
    }
</style>
@endsection
