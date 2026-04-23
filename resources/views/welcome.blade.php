<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benedicto College - Facility Reservation System</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="main-container" id="container">
        {{-- 1. Login Container --}}
        <div class="form-container login-container">
            <div class="blue-panel left-panel">
                <div class="panel-content">
                    <h1>Welcome to Benedicto College!</h1>
                    <p>Please sign in to view availability and manage your reservations.</p>
                </div>
            </div>
            
            <div class="form-content">
                <div class="header-info">
                    <img src="https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/380790490_810610521073768_1413158087196732061_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=1d70fc&_nc_eui2=AeGevFTcyEEg8FLGksLW7tfTjRg-_uuZFZaNGD7-65kVliRyjXxY9EBA6fdLY3Sse2cl7Rr7XKRfrgnlO7BXAlKk&_nc_ohc=BEbMybC7YaoQ7kNvwFs2Xgt&_nc_oc=AdrDjaS_4FnAUAWdnWHNQ8PuNg3m5tq_2lZjB81kVTTlS949nfcckFaQ3KL31IaiViQ&_nc_zt=23&_nc_ht=scontent.fmnl17-3.fna&_nc_gid=5sme3GwOATBZqgDoZGYyJA&_nc_ss=7a2a8&oh=00_Af18jYM64aY1dFta-gIkhkL5ZgsmPZVadcsVSEy3MABGxg&oe=69EED510" alt="BC Logo" class="logo"> 
                    <h3>Facility Reservation System</h3>
                </div>
                <h2>Login</h2>
                <p class="subtitle">Enter your credentials to access your account</p>

                {{-- Status Message for Password Reset --}}
                @if (session('status'))
                    <div style="color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px;">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>School ID</label>
                        <div class="input-field">
                            <input type="text" name="student_id" placeholder="2026-00057" required autofocus>
                            <i class='bx bxs-user'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-field">
                            <input type="password" name="password" placeholder="Enter your password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>
                    </div>

                    {{-- Forgot Password Link --}}
                    <div style="text-align: right; margin-bottom: 15px;">
                        <a href="{{ route('password.request') }}" style="color: #2b7fff; text-decoration: none; font-size: 13px;">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-signin">Sign in <i class='bx bx-log-in-circle'></i></button>
                </form>

                <p class="toggle-text">Don't have an account? <span id="toSignUp">Sign up</span></p>
            </div>
        </div>

        {{-- 2. Signup Container --}}
        <div class="form-container signup-container">
            <div class="form-content">
                <h2>Create Account</h2>
                <div class="signup-header">
                    <h3>Sign Up</h3>
                    <p class="subtitle">Create your account</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label>Full Name</label>
                        <div class="input-field">
                            <input type="text" name="name" placeholder="Juan Dela Cruz" required>
                            <i class='bx bxs-user-detail'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Email</label>
                        <div class="input-field">
                            <input type="email" name="email" placeholder="example@gmail.com" required>
                            <i class='bx bxs-envelope'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Student/Faculty ID</label>
                        <div class="input-field">
                            <input type="text" name="student_id" placeholder="2026-00057" required>
                            <i class='bx bxs-id-card'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-field">
                            <input type="password" name="password" placeholder="Minimum 8 characters" required>
                            <i class='bx bxs-lock-open-alt'></i>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Confirm Password</label>
                        <div class="input-field">
                            <input type="password" name="password_confirmation" placeholder="Re-enter your password" required>
                            <i class='bx bxs-lock-alt'></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-create">Create Account <i class='bx bx-user-plus'></i></button>
                </form>
            </div>

            <div class="blue-panel right-panel">
                <div class="panel-content">
                    <h1>Welcome to Benedicto College!</h1>
                    <p>Already have an account?</p>
                    <button class="btn-outline" id="toLoginBtn">Login</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>