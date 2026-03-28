<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Reservation System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        @include('partial._sidebar')

        <main class="main-content">
            @include('partial._header')

            <div class="content-area">
                @yield('content')
            </div>

            @include('partial._footer')
        </main>
    </div>
</body>
</html>
