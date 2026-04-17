<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — Obscura</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    {{-- Toast --}}
    @if(session('success'))
        <div class="toast toast--success" id="toast-notification">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif

    <div class="admin-layout">
        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="sidebar__brand">
                <a href="{{ route('home') }}">Obscura</a>
                <span class="sidebar__badge">Admin</span>
            </div>
            <nav class="sidebar__nav">
                <a href="{{ route('admin.dashboard') }}" class="sidebar__link {{ request()->routeIs('admin.dashboard') ? 'sidebar__link--active' : '' }}">
                    <span class="sidebar__icon">▢</span> Dashboard
                </a>
                <a href="{{ route('admin.reservations.index') }}" class="sidebar__link {{ request()->routeIs('admin.reservations.*') ? 'sidebar__link--active' : '' }}">
                    <span class="sidebar__icon">▤</span> Reservations
                </a>
                <a href="{{ route('admin.menu.index') }}" class="sidebar__link {{ request()->routeIs('admin.menu.*') ? 'sidebar__link--active' : '' }}">
                    <span class="sidebar__icon">◉</span> Menu
                </a>
            </nav>
            <div class="sidebar__footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar__link sidebar__link--logout">
                        <span class="sidebar__icon">↩</span> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="admin-main">
            <header class="admin-header">
                <h1 class="admin-header__title">@yield('page-title', 'Dashboard')</h1>
                @yield('header-actions')
            </header>
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const toast = document.getElementById('toast-notification');
        if (toast) setTimeout(() => toast.remove(), 4000);
    </script>
    @stack('scripts')
</body>
</html>
