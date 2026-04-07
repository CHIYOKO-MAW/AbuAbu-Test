@props([
    'album',
    'lang' => 'en',
    'showMetaBar' => true,
])

@php
    $href = route('audio.show', ['artist' => $album['artist_slug'], 'album' => $album['slug'], 'lang' => $lang]);
@endphp

<article class="group rounded-[26px] border border-white/6 bg-[linear-gradient(180deg,rgba(255,255,255,0.03),rgba(255,255,255,0.015))] p-3 transition duration-300 hover:-translate-y-1 hover:border-white/12 hover:bg-[linear-gradient(180deg,rgba(255,255,255,0.045),rgba(255,255,255,0.02))]">
    <x-audio.cover :album="$album" :href="$href" />

    <div class="mt-4 px-1 pb-1">
        <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
                <a href="{{ $href }}" class="block text-[1.02rem] leading-7 text-white transition group-hover:text-[#9bd0ff]">
                    {{ $album['title'] }}
                </a>
                <div class="mt-1 text-[0.94rem] text-white/56">{{ $album['artist'] }}</div>
            </div>
            <span class="rounded-full border border-white/8 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-white/45">
                {{ strtoupper($album['type']) }}
            </span>
        </div>

        @if ($showMetaBar)
            <div class="mt-4 grid gap-2 text-xs text-white/50 sm:grid-cols-2">
                <div class="rounded-2xl border border-white/6 bg-[#15191f] px-3 py-2">
                    <div class="text-[10px] uppercase tracking-[0.24em] text-white/32">Genre</div>
                    <div class="mt-1 text-white/72">{{ $album['genre'] }}</div>
                </div>
                <div class="rounded-2xl border border-white/6 bg-[#15191f] px-3 py-2">
                    <div class="text-[10px] uppercase tracking-[0.24em] text-white/32">Format</div>
                    <div class="mt-1 text-white/72">{{ implode(' / ', array_slice($album['formats'], 0, 2)) }}</div>
                </div>
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between gap-3 text-[11px] uppercase tracking-[0.22em]">
            <span class="text-white/34">{{ $album['download']['size'] ?? 'Archive pending' }}</span>
            <span class="rounded-full px-3 py-1 {{ $album['download']['available'] ? 'bg-[#00B894]/12 text-[#8fe4d2]' : 'bg-white/[0.04] text-white/38' }}">
                {{ $album['download']['available'] ? 'album download' : 'not available yet' }}
            </span>
        </div>
    </div>
</article>
