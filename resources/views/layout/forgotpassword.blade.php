<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Benedicto College</title>
    {{-- Using your existing login.css --}}
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="main-container">
        <div class="form-container login-container">
            {{-- Left Blue Panel --}}
            <div class="blue-panel left-panel">
                <div class="panel-content">
                    <h1>Recover Account</h1>
                    <p>Enter your registered email address to receive a password reset link.</p>
                </div>
            </div>
            
            <div class="form-content">
                <div class="header-info">
                    <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/380790490_810610521073768_1413158087196732061_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=1d70fc&_nc_eui2=AeGevFTcyEEg8FLGksLW7tfTjRg-_uuZFZaNGD7-65kVliRyjXxY9EBA6fdLY3Sse2cl7Rr7XKRfrgnlO7BXAlKk&_nc_ohc=BEbMybC7YaoQ7kNvwFs2Xgt&_nc_oc=AdrDjaS_4FnAUAWdnWHNQ8PuNg3m5tq_2lZjB81kVTTlS949nfcckFaQ3KL31IaiViQ&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=5sme3GwOATBZqgDoZGYyJA&_nc_ss=7a2a8&oh=00_Af18jYM64aY1dFta-gIkhkL5ZgsmPZVadcsVSEy3MABGxg&oe=69EED510" alt="BC Logo" class="logo"> 
                    <h3>Facility Reservation System</h3>
                </div>

                <h2>Forgot Password</h2>
                <p class="subtitle">Instructions will be sent to your email</p>

                {{-- Success Message --}}
                @if (session('status'))
                    <div class="alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>Email Address</label>
                        <div class="input-field">
                            <input type="email" name="email" placeholder="example@gmail.com" required autofocus>
                            <i class='bx bxs-envelope'></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-signin">Send Reset Link <i class='bx bx-paper-plane'></i></button>
                </form>

                <p class="toggle-text">
                    <a href="{{ route('welcome') }}" style="text-decoration:none;">
                        <span>Back to Login</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>