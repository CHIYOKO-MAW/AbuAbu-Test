@props([
    'album',
    'size' => 'card',
    'href' => null,
])

@php
    $palette = $album['cover']['palette'];
    $accent = $album['cover']['accent'];
    $title = $album['title'];
    $artist = $album['artist'];
    $coverImage = $album['cover']['image'] ?? null;
    $coverAlt = $album['cover']['alt'] ?? ($title.' cover artwork');
    $hasImage = (bool) ($album['cover']['available'] ?? false) && is_string($coverImage);
    $wrapperClass = match ($size) {
        'hero' => 'aspect-square w-full max-w-[340px]',
        'related' => 'aspect-square w-full',
        default => 'aspect-square w-full',
    };
    $contentClass = match ($size) {
        'hero' => 'p-7',
        'related' => 'p-4',
        default => 'p-5',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" class="block {{ $wrapperClass }}">
@else
    <div class="{{ $wrapperClass }}">
@endif
    <div
        class="relative h-full overflow-hidden rounded-[22px] border border-white/8 shadow-[0_18px_34px_rgba(0,0,0,0.28)]"
        style="background: linear-gradient(145deg, {{ $palette[0] }} 0%, {{ $palette[1] }} 55%, {{ $palette[2] }} 100%);"
    >
        @if ($hasImage)
            <img
                src="{{ asset($coverImage) }}"
                alt="{{ $coverAlt }}"
                class="h-full w-full object-cover"
            >
            <div class="absolute inset-0 bg-[linear-gradient(to_bottom,rgba(0,0,0,0.06),transparent_36%,rgba(5,7,10,0.62))]"></div>
            <div class="absolute inset-3 rounded-[18px] border border-white/10"></div>
            <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5">
                <div class="inline-flex items-center gap-2 rounded-full bg-black/45 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.24em] text-white/82 backdrop-blur-sm">
                    <span>{{ strtoupper($artist) }}</span>
                    <span class="text-white/40">/</span>
                    <span>{{ strtoupper($album['type']) }}</span>
                </div>
            </div>
        @else
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.20),transparent_24%),linear-gradient(to_bottom,transparent,rgba(0,0,0,0.28))]"></div>
            <div class="absolute inset-3 rounded-[18px] border border-white/10"></div>
            <div class="relative flex h-full flex-col justify-between {{ $contentClass }}" style="color: {{ $accent }};">
                <div class="flex items-start justify-between gap-4">
                    <span class="text-[10px] font-semibold uppercase tracking-[0.32em] opacity-75">{{ strtoupper($artist) }}</span>
                    <span class="rounded-full border border-current/30 px-2 py-1 text-[10px] uppercase tracking-[0.24em] opacity-70">{{ strtoupper($album['type']) }}</span>
                </div>
                <div>
                    <div class="font-display text-3xl font-bold leading-tight {{ $size === 'hero' ? 'sm:text-4xl' : 'text-2xl' }}">
                        {{ $title }}
                    </div>
                    <div class="mt-2 text-sm opacity-85">{{ $artist }}</div>
                </div>
            </div>
        @endif
    </div>
@if ($href)
    </a>
@else
    </div>
@endif
