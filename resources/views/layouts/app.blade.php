<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#0F1115">
        <meta name="description" content="@yield('description', config('abuabu.brand.description'))">

        <title>@yield('title', config('abuabu.brand.name'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|space-grotesk:400,500,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#0F1115] text-[#EAEAF0] selection:bg-[#6C5CE7] selection:text-white">
        <div class="relative isolate overflow-hidden">
            <div class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.22),transparent_32%),radial-gradient(circle_at_top_right,rgba(0,184,148,0.14),transparent_24%),radial-gradient(circle_at_bottom_right,rgba(253,203,110,0.10),transparent_22%)]"></div>
            <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-64 bg-gradient-to-b from-white/[0.05] to-transparent"></div>

            @yield('content')
        </div>
    </body>
</html>
