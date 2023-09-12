<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete your registration process - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/components/header.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ asset('storage/utilities/auth/authorization-2.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/auth/utilities.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.auth.header')
    <main class="auth-container">
        <div class="auth-wrapper">
            <form action="{{ route('signup.post') }}" method="POST" autocomplete="off" class="onboarding" id="authentication">
                @include('auth.error&success.error')
                @include('auth.error&success.success')
                @csrf
                <input type="text" name="email" id="email" value="{{ $email }}">
            </form>
        </div>
    </main>
    <script src="{{ asset('storage/utilities/auth/js/6urye68tv3k0oo3n20sd.js') }}"></script>
</body>

</html>
