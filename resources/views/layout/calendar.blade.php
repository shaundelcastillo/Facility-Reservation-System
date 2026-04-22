<!DOCTYPE html>
<html>
<head>
    <title>Facility Management - Calendar</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> @stack('styles')
</head>
<body>
    <div class="dashboard-container" style="display: flex; min-height: 100vh;">
        @include('partial._sidebar') 

        <main class="main-content" style="flex: 1; background-color: #f4f7fe; padding: 20px;">
            @yield('content')
        </main>
    </div>
</body>
</html>