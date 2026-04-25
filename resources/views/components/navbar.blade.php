@props([
    'brand' => ['name' => config('abuabu.brand.name'), 'tagline' => config('abuabu.brand.tagline')],
    'navigation' => [],
])

<header class="fixed inset-x-0 top-0 z-50 px-4 pt-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl rounded-3xl border border-white/10 bg-[#10131A]/90 shadow-[0_20px_60px_rgba(0,0,0,0.34)] backdrop-blur-xl">
        <div class="flex items-center justify-between gap-4 px-4 py-4 sm:px-6">
            <a href="/" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.05] font-display text-lg font-bold tracking-wide text-white">
                    AA
                </span>
                <span class="flex flex-col">
                    <span class="font-display text-lg font-bold tracking-wide text-white">{{ $brand['name'] ?? config('abuabu.brand.name') }}</span>
                    <span class="text-xs text-[#A0A3BD]">{{ \App\Support\AbuAbu::text($brand['tagline'] ?? config('abuabu.brand.tagline'), $lang) }}</span>
                </span>
            </a>

<nav class="hidden items-center gap-2 md:flex">
                @foreach ($navigation as $item)
                    <a
                        href="{{ $item['href'] }}"
                        class="rounded-full px-4 py-2 text-sm font-medium text-[#A0A3BD] transition hover:bg-white/[0.06] hover:text-white"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <details class="relative md:hidden">
                <summary class="list-none rounded-full border border-white/10 bg-white/[0.04] px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/[0.08]">
                    Menu
                </summary>
                <div class="absolute right-0 mt-3 w-56 rounded-3xl border border-white/10 bg-[#11141B] p-3 shadow-[0_20px_50px_rgba(0,0,0,0.35)]">
                    <div class="space-y-1">
                        @foreach ($navigation as $item)
                            <a
                                href="{{ $item['href'] }}"
                                class="block rounded-2xl px-4 py-3 text-sm font-medium text-[#EAEAF0] transition hover:bg-white/[0.06]"
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </details>
        </div>
    </div>
</header>
