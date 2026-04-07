@props([
    'brand' => ['name' => config('abuabu.brand.name')],
    'links' => [],
    'disclaimer' => null,
    'lang' => 'id',
])

<footer class="mt-20 border-t border-white/10">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[1fr_0.8fr] lg:items-start">
            <div>
                <div class="font-display text-xl font-bold text-white">{{ $brand['name'] ?? config('abuabu.brand.name') }}</div>
                <p class="mt-4 max-w-3xl text-sm leading-7 text-[#A0A3BD]">
                    {{ \App\Support\AbuAbu::text($disclaimer ?? config('abuabu.footer.disclaimer'), $lang) }}
                </p>
            </div>

            <div class="grid gap-3 sm:grid-cols-2 lg:justify-items-end">
                @foreach ($links as $link)
                    <a
                        href="{{ $link['href'] }}"
                        class="rounded-2xl border border-white/10 bg-white/[0.03] px-4 py-3 text-sm font-medium text-[#EAEAF0] transition hover:bg-white/[0.06]"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-2 border-t border-white/10 pt-6 text-xs text-[#A0A3BD] sm:flex-row sm:items-center sm:justify-between">
            <span>{{ $lang === 'id' ? 'Frontend shell untuk arsip yang masih terus dibentuk.' : 'A frontend shell for an archive still taking shape.' }}</span>
            <span>{{ $lang === 'id' ? 'Navigasi tetap terang, suasana boleh samar.' : 'The navigation stays clear, even when the atmosphere does not.' }}</span>
        </div>
    </div>
</footer>
