<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HR support and management system - {{ config('app.name') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/style.css?v=1.0') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/utilities/components/header.css?v=1.0') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('storage/assets/fonts/icofont/icofont.min.css?v=1.0') }}">
    </head>
    <body class="antialiased">
        @include('utilities.header')
        
    </body>
</html>
