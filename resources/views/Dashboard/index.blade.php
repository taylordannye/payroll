<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Manange all employees data and assets! - {{ config('app.name') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/dashboard/header.css?v=1.0') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/dashboard/dashboard.css?v=1.0') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/dashboard/utilizer.css?v=1.0') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
    </head>
    <body class="antialiased">
        @include('utilities.dashboard.header')
        <main class="full-grid-flow">
            <div class="navigation-panel-flow">
                <div class="help-and-support">
                    <button><img src="{{ asset('storage/utilities/components/auth/k41ssedgxyu0q1qxhb3d.svg') }}" alt="info">Help & Support</button>
                </div>
                <div class="copyright">
                    <p>&copy; {{ config('app.name') }} - <?php echo date("Y") ?> - all rights reserved.</p>
                </div>
            </div>
            <div class="main-preview-screen"></div>
        </main>
    </body>
</html>
