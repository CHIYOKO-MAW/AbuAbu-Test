<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#171a1d">
        <meta name="description" content="@yield('description', config('abuabu.brand.description'))">

        <title>@yield('title', 'Abu-Abu Audio')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|space-grotesk:400,500,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#2f3338] text-[#f5f7fa] selection:bg-[#3d9ae9] selection:text-white">
        @yield('content')
    </body>
</html>
