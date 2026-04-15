<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benedicto College - Facility Reservation</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="dashboard-container">
    {{-- Sidebar --}}
    @include('partial._sidebar')

    <main class="main-content">
        {{-- Header / Top Bar --}}
        @include('partial._header')

        {{-- Main content area --}}
        <div class="content-area">
            @yield('content')
        </div>

        {{-- Footer --}}
        @include('partial._footer')
    </main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>