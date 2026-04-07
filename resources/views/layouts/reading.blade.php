<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f7f2e8">
        <meta name="description" content="@yield('description', config('abuabu.brand.description'))">

        <title>@yield('title', 'Abu-Abu Reading')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700|manrope:400,500,600,700,800" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f2e8] text-[#2b2620] selection:bg-[#b8c7aa] selection:text-[#1f221c]">
        @yield('content')
    </body>
</html>
