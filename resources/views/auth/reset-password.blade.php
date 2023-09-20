<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change password and recover account access! - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/header.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/authorization.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.auth.header')
    @include('utilities.loader')
    <main class="auth-container">
        <div class="auth-wrapper">
            <form action="#" method="POST" autocomplete="off" class="onboarding" id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @csrf
                <input type="text" name="token" hidden value="{{ $token }}">
                <div class="divider-liner">
                    <span class="line"></span>Enter a new password below<span class="line"></span>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" value="{{ $email }}"
                        @required(true) @disabled(true)>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Enter new password"
                        @required(true)>
                </div>
                <div class="btn-group">
                    <button type="submit" id="submit" class="submit-btn">Confirm changes</button>
                    <div id="loader" class="loader-wrapper">
                        <!-- Ripple Loader -->
                        <div class="ripple-loader">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="auth-membership-status max-m">
                    <p>Don't wan't to reset your password anymore? <a href="{{ route('cancel-reset') }}">Cancel process</a>
                    </p>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('storage/utilities/auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
