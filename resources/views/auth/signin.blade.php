<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>We're glad to see you back! - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/components/header.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/authorization.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.auth.header')
    @include('utilities.loader')
    <main class="auth-container contents">
        <div class="auth-wrapper">
            <form action="#" method="POST" autocomplete="off" class="singin" id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @csrf
                <div class="auth-heading">
                    <h1>Welcome Back!</h1>
                </div>
                <div class="divider-liner">
                    <span class="line"></span>Continue with email & password<span class="line"></span>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="example@gmail.com"
                        @required(true)>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="***************"
                        @required(true)>
                </div>
                <div class="btn-group">
                    <button type="submit" id="submit" class="submit-btn">Sign
                        in to your account</button>
                    <div id="loader" class="loader-wrapper">
                        <!-- Ripple Loader -->
                        <div class="ripple-loader">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="auth-membership-status">
                    <p>Don't have a {{ config('app.name') }} account? <a href="{{ route('signup') }}">Sign-up</a></p>
                </div>
                <div class="auth-account-sign-trouble">
                    <p><a href="{{ route('forgot-password') }}">Forgot password?</a></p>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
