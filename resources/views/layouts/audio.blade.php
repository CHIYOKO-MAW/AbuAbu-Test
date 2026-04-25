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
        
        <footer class="border-t border-white/6 bg-[#1a1e24] py-8 mt-16">
            <div class="mx-auto max-w-[1460px] px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-white/40">
                    <a href="/" class="hover:text-white transition">Home</a>
                    <a href="{{ route('audio.index') }}" class="hover:text-white transition">Catalog</a>
                    <a href="{{ route('wishlist') }}" class="hover:text-white transition">Wishlist</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Admin</a>
                </div>
                <div class="mt-4 text-center text-xs text-white/30">
                    &copy; {{ date('Y') }} Abu-Abu Audio. Lossless music downloads.
                </div>
            </div>
        </footer>

        <button x-data x-init="window.addEventListener('scroll', () => { $el.classList.toggle('opacity-0', window.scrollY < 500) })" x-show="false" x-transition.opacity onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-[#3d9ae9] text-white shadow-lg hover:bg-[#52a8f0] transition opacity-0 pointer-events-none" aria-label="Back to top">
            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </body>
</html>
