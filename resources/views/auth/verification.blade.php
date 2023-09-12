<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm action with OTP - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/components/header.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/authorization.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.auth.header')
    <main class="auth-container">
        <div class="auth-wrapper">
            <form action="#" method="POST" autocomplete="off" class="onboarding" id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @csrf
                <div class="auth-heading">
                    <div class="icon">
                        <img src="{{ asset('storage/utilities/components/auth/d38hgoz1o92pqiz3qwd6.png') }}"
                            alt="One-Time-Password">
                    </div>
                    <h1>Security Check</h1>
                </div>
                <div class="divider-liner">
                    <span class="line"></span>Please enter the OTP sent to your email<span class="line"></span>
                </div>
                <div class="input-group otp-postion-change">
                    <input type="number" id="otp" name="otp" length="6" placeholder="000000" value="{{ old('otp') }}"
                        @required(true)>
                        <div class="security-img">
                            <img src="{{ asset('storage/utilities/components/auth/ae5oyfyfmp5up4lm97ek.png') }}" alt="security" title="Secured-Input">
                        </div>
                </div>
                <div class="btn-group">
                    <button type="submit" id="submit" class="submit-btn">Submit</button>
                    <div id="loader" class="loader-wrapper">
                        <!-- Ripple Loader -->
                        <div class="ripple-loader">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="auth-membership-status">
                    <p>Didn't receive the OTP? <a href="{{ route('resend-verification') }}">Resend</a></p>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
