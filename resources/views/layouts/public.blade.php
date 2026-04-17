<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Obscura — An exclusive fine-dining experience. Reserve your table for a singular evening of culinary artistry.">

    <title>{{ $title ?? 'Obscura — Fine Dining' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Toast Notification -->
    @if(session('success'))
        <div class="toast toast--success" id="toast-notification">
            <span class="toast__icon">✓</span>
            <span class="toast__message">{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="toast toast--error" id="toast-notification">
            <span class="toast__icon">✕</span>
            <span class="toast__message">{{ $errors->first() }}</span>
        </div>
    @endif

    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/animations.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
