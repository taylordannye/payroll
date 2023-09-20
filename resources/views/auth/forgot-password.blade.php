<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Let's help you recover your password - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/header.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/authorization.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.auth.header')
    @include('utilities.loader')
    <main class="auth-container">
        <div class="auth-wrapper">
            <form action="{{ route('forgot-password.post') }}" method="POST" autocomplete="off" class="onboarding"
                id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @csrf
                <div class="auth-heading">
                    <h1>Recover account access</h1>
                </div>
                <div class="divider-liner">
                    <span class="line"></span>Enter email-id to reset password<span class="line"></span>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="example@gmail.com"
                        value="{{ old('email') }}" @required(true)>
                </div>
                <div class="btn-group">
                    <button type="submit" id="submit" class="submit-btn">Send reset instructions</button>
                    <div id="loader" class="loader-wrapper">
                        <!-- Ripple Loader -->
                        <div class="ripple-loader">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="auth-membership-status max-m">
                    <p>I remember my {{ config('app.name') }} password now! <a href="{{ route('signin') }}">Sign-in</a>
                    </p>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('storage/utilities/auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
