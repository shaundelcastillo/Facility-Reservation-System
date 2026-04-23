<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - Benedicto College</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="form-container login-container">
            {{-- Left Panel --}}
            <div class="blue-panel left-panel">
                <div class="panel-content">
                    <h1>New Password</h1>
                    <p>Almost there! Create a strong password to secure your facility reservation account.</p>
                </div>
            </div>
            
            <div class="form-content">
                <div class="header-info">
                    <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/380790490_810610521073768_1413158087196732061_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=1d70fc&_nc_eui2=AeGevFTcyEEg8FLGksLW7tfTjRg-_uuZFZaNGD7-65kVliRyjXxY9EBA6fdLY3Sse2cl7Rr7XKRfrgnlO7BXAlKk&_nc_ohc=BEbMybC7YaoQ7kNvwFs2Xgt&_nc_oc=AdrDjaS_4FnAUAWdnWHNQ8PuNg3m5tq_2lZjB81kVTTlS949nfcckFaQ3KL31IaiViQ&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=5sme3GwOATBZqgDoZGYyJA&_nc_ss=7a2a8&oh=00_Af18jYM64aY1dFta-gIkhkL5ZgsmPZVadcsVSEy3MABGxg&oe=69EED510" alt="BC Logo" class="logo"> 
                    <h3>Facility Reservation System</h3>
                </div>

                <h2>Update Password</h2>
                <p class="subtitle">Complete the fields below to finish</p>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    {{-- Hidden token required by Laravel for security --}}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group">
                        <label>Confirm Email</label>
                        <div class="input-field">
                            <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="example@gmail.com" required autofocus>
                            <i class='bx bxs-envelope'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>New Password</label>
                        <div class="input-field">
                            <input type="password" name="password" placeholder="Minimum 8 characters" required>
                            <i class='bx bxs-lock-open-alt'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Confirm New Password</label>
                        <div class="input-field">
                            <input type="password" name="password_confirmation" placeholder="Repeat new password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-signin">Reset Password <i class='bx bx-check-shield'></i></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>