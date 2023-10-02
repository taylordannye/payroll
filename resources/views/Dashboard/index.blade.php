<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/dashboard/header.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/dashboard/index.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/dashboard/utilizer.css?v=1.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
</head>

<body class="antialiased">
    @include('utilities.dashboard.header')
    <main class="main-wrapper">
        <div class="vx_row">
            <div class="vx_col-md-12 vx_col-lg-4"></div>
            <div class="quick-links-layout"></div>
        </div>
    </main>
</body>

</html>
