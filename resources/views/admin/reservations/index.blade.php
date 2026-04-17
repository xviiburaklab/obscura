@extends('layouts.admin')
@section('page-title', 'Reservations')

@section('content')
<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Guest</th>
                <th>Email</th>
                <th>Date</th>
                <th>Pax</th>
                <th>Status</th>
                <th>Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $r)
                <tr>
                    <td style="font-weight:500; color:var(--clr-white);">{{ $r->confirmation_code }}</td>
                    <td>{{ $r->first_name }} {{ $r->last_name }}</td>
                    <td>{{ $r->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($r->date)->format('M j, Y') }}</td>
                    <td>{{ $r->guests }}</td>
                    <td><span class="badge badge--{{ $r->status->value }}">{{ $r->status->label() }}</span></td>
                    <td style="color:var(--clr-text-dim);">{{ $r->created_at->format('M j, H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.reservations.show', $r) }}" class="btn btn--sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-state__icon">◇</div>
                            <p>No reservations yet.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $reservations->links() }}
</div>
@endsection
