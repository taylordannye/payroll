<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create a free account now! - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/header.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('storage/utilities/auth/authorization.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.auth.header')
    @include('utilities.loader')
    <main class="auth-container">
        <div class="auth-wrapper">
            <form action="{{ route('signup.post') }}" method="POST" autocomplete="off" class="onboarding"
                id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @csrf
                <div class="auth-heading">
                    <h1>Create your account</h1>
                </div>
                <button type="button" class="o2auth-wrapper" id="google-authentication">
                    <img class="o2auth-img" src="{{ asset('storage/assets/images/02auth/0stabk39m4jm5xbznqmp.png') }}"
                        alt="Google">
                    <div class="text">Continue with Google</div>
                </button>
                <div class="divider-liner">
                    <span class="line"></span>Or continue with email<span class="line"></span>
                </div>
                <div class="input-group">
                    <input type="text" id="email" name="email" placeholder="example@gmail.com"
                        @required(true)>
                </div>
                <div class="btn-group">
                    <button type="submit" id="submit" class="submit-btn">Continue</button>
                    <div id="loader" class="loader-wrapper">
                        <!-- Ripple Loader -->
                        <div class="ripple-loader">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="auth-membership-status">
                    <p>Already have a {{ config('app.name') }} account? <a href="{{ route('signin') }}">Sign-in</a></p>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const googleButton = document.getElementById("google-authentication");
            let originalButtonContent = googleButton.innerHTML; // Store the original button content
            googleButton.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the default navigation behavior
                // Change button to loader with a message
                googleButton.innerHTML = '<div class="loader"></div>&nbsp; Redirecting to O2auth server';
                setTimeout(function() {
                    // Check if the user is online before navigation
                    if (navigator.onLine) {
                        window.location.href = "sign-in";
                    } else {
                        // Display an error message
                        googleButton.innerHTML =
                            '<i class="icofont-link-broken"></i>&nbsp; Connection died, click to retry.';

                        // Restore the original button content after 4 seconds
                        setTimeout(function() {
                            googleButton.innerHTML = originalButtonContent;
                        }, 30000); // 30 seconds
                    }
                }, 5000); // 5 seconds
            });
        });
    </script>
    <script src="{{ asset('storage/utilities/auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
