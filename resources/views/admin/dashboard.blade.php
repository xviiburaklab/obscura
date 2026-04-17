@extends('layouts.admin')

@section('page-title', 'Overview')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <label>Today</label>
        <div class="stat-card__value">{{ $stats['today'] }}</div>
        <p>Reservations for today</p>
    </div>
    <div class="stat-card">
        <label>This Week</label>
        <div class="stat-card__value">{{ $stats['this_week'] }}</div>
        <p>Total requests</p>
    </div>
    <div class="stat-card">
        <label>Pending</label>
        <div class="stat-card__value text-gold">{{ $stats['pending'] }}</div>
        <p>Needs review</p>
    </div>
    <div class="stat-card">
        <label>Menu Items</label>
        <div class="stat-card__value">{{ $stats['total_menu'] }}</div>
        <p>Active courses</p>
    </div>
</div>

<div class="dashboard-grid">
    <div class="dashboard-section">
        <div class="section-header">
            <h2 class="section-header__title">Upcoming Journey</h2>
            <a href="{{ route('admin.reservations.index') }}" class="btn-text">View all</a>
        </div>
        
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Guest</th>
                        <th class="text-right">Size</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcomingReservations as $reservation)
                        <tr>
                            <td>{{ $reservation->date->format('M d, Y') }}</td>
                            <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                            <td class="text-right">{{ $reservation->guests }}</td>
                            <td>
                                <span class="status-indicator status-indicator--{{ $reservation->status->value }}"></span>
                                {{ ucfirst($reservation->status->value) }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn-icon">→</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No upcoming reservations</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
