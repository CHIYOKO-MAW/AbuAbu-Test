<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#121512">
        <meta name="description" content="@yield('description', config('abuabu.brand.description'))">

        <title>@yield('title', 'Abu-Abu Tools')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=ibm-plex-sans:400,500,600,700|ibm-plex-mono:400,500,600|space-grotesk:500,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#121512] text-[#ecf1e8] selection:bg-[#c9ff4d] selection:text-[#11140f]" style="font-family: 'IBM Plex Sans', sans-serif;">
        @yield('content')
    <style>
  @keyframes shift {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
  }
</style>
</body>
</html>
