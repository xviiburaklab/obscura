@extends('layouts.admin')
@section('page-title', 'Menu Items')

@section('header-actions')
    <a href="{{ route('admin.menu.create') }}" class="btn btn--primary btn--sm">+ Add Item</a>
@endsection

@section('content')
<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Course</th>
                <th>Title</th>
                <th>Description</th>
                <th>Active</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($menuItems as $item)
                <tr>
                    <td style="color:var(--clr-text-dim);">{{ $item->sort_order }}</td>
                    <td>{{ $item->course }}</td>
                    <td style="font-weight:500; color:var(--clr-white);">{{ $item->title }}</td>
                    <td style="max-width:300px; color:var(--clr-text-muted);">{{ Str::limit($item->description, 80) }}</td>
                    <td>
                        @if($item->is_active)
                            <span style="color:var(--clr-success);">●</span>
                        @else
                            <span style="color:var(--clr-text-dim);">○</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-bar">
                            <a href="{{ route('admin.menu.edit', ['menu' => $item]) }}" class="btn btn--sm">Edit</a>
                            <form method="POST" action="{{ route('admin.menu.destroy', ['menu' => $item]) }}" onsubmit="return confirm('Delete this item?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-state__icon">◉</div>
                            <p>No menu items. <a href="{{ route('admin.menu.create') }}">Add one</a>.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
