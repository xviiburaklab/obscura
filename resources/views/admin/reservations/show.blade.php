@extends('layouts.admin')
@section('page-title', 'Reservation · ' . $reservation->confirmation_code)

@section('header-actions')
    <a href="{{ route('admin.reservations.index') }}" class="btn btn--sm">← Back to list</a>
@endsection

@section('content')

{{-- Guest Info --}}
<div class="card">
    <h3 class="card__title">Guest Information</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-item__label">Name</div>
            <div class="detail-item__value">{{ $reservation->first_name }} {{ $reservation->last_name }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-item__label">Email</div>
            <div class="detail-item__value">{{ $reservation->email }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-item__label">Phone</div>
            <div class="detail-item__value">{{ $reservation->phone ?? '—' }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-item__label">Confirmation Code</div>
            <div class="detail-item__value" style="color:var(--clr-accent); font-weight:500;">{{ $reservation->confirmation_code }}</div>
        </div>
    </div>
</div>

{{-- Reservation Details --}}
<div class="card">
    <h3 class="card__title">Reservation Details</h3>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-item__label">Date</div>
            <div class="detail-item__value">{{ \Carbon\Carbon::parse($reservation->date)->format('l, F j, Y') }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-item__label">Guests</div>
            <div class="detail-item__value">{{ $reservation->guests }}</div>
        </div>
        <div class="detail-item">
            <div class="detail-item__label">Status</div>
            <div class="detail-item__value"><span class="badge badge--{{ $reservation->status->value }}">{{ $reservation->status->label() }}</span></div>
        </div>
        <div class="detail-item">
            <div class="detail-item__label">Submitted</div>
            <div class="detail-item__value">{{ $reservation->created_at->format('M j, Y \a\t H:i') }}</div>
        </div>
    </div>
    @if($reservation->notes)
        <div style="margin-top:1.25rem; padding-top:1.25rem; border-top:1px solid var(--clr-border);">
            <div class="detail-item__label">Guest Notes</div>
            <p style="margin-top:0.4rem; color:var(--clr-text); font-style:italic;">{{ $reservation->notes }}</p>
        </div>
    @endif
</div>

{{-- Actions --}}
<div class="card">
    <h3 class="card__title">Actions</h3>
    <div class="action-bar" style="margin-bottom:1.5rem;">
        @if($reservation->status->value === 'pending')
            <form method="POST" action="{{ route('admin.reservations.update_status', $reservation) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="confirmed">
                <button type="submit" class="btn btn--success btn--sm">✓ Confirm</button>
            </form>
            <form method="POST" action="{{ route('admin.reservations.update_status', $reservation) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="btn btn--danger btn--sm">✕ Reject</button>
            </form>
        @elseif($reservation->status->value === 'confirmed')
            <form method="POST" action="{{ route('admin.reservations.update_status', $reservation) }}">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="cancelled">
                <button type="submit" class="btn btn--danger btn--sm">Cancel Reservation</button>
            </form>
        @endif
    </div>

    {{-- Admin Notes --}}
    <form method="POST" action="{{ route('admin.reservations.update_notes', $reservation) }}">
        @csrf @method('PATCH')
        <div class="admin-form__group">
            <label class="admin-form__label" for="admin_notes">Admin Notes</label>
            <textarea class="admin-form__textarea" id="admin_notes" name="admin_notes" placeholder="Internal notes about this reservation…">{{ $reservation->admin_notes }}</textarea>
        </div>
        <button type="submit" class="btn btn--primary btn--sm" style="margin-top:0.75rem;">Save Notes</button>
    </form>
</div>

@endsection
