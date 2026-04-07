<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#16120f">
        <meta name="description" content="@yield('description', config('abuabu.brand.description'))">

        <title>@yield('title', 'Abu-Abu Request')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|space-grotesk:400,500,700|ibm-plex-mono:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#14110e] text-[#f3ede6] selection:bg-[#f6b26b] selection:text-[#1c140d]">
        @yield('content')
    </body>
</html>
