@props([
    'item',
    'size' => 'card',
    'href' => null,
])

@php
    $palette = $item['cover']['palette'] ?? ['#f6efe4', '#c8b69e', '#41372c'];
    $coverImage = $item['cover']['image'] ?? null;
    $coverAlt = $item['cover']['alt'] ?? ($item['title'].' cover');
    $hasImage = (bool) ($item['cover']['available'] ?? false) && is_string($coverImage);
    $wrapperClass = match ($size) {
        'hero' => 'aspect-[0.8] w-full max-w-[320px]',
        default => 'aspect-[0.8] w-full',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" class="block {{ $wrapperClass }}">
@else
    <div class="{{ $wrapperClass }}">
@endif
    <div class="relative h-full overflow-hidden rounded-[24px] border border-[#ded2c1] bg-[#f8f2e9] shadow-[0_16px_30px_rgba(79,63,40,0.10)]">
        @if ($hasImage)
            <img src="{{ asset($coverImage) }}" alt="{{ $coverAlt }}" class="h-full w-full object-cover">
        @else
            <div class="absolute inset-0" style="background: linear-gradient(160deg, {{ $palette[0] }} 0%, {{ $palette[1] }} 58%, {{ $palette[2] }} 100%);"></div>
            <div class="absolute inset-4 rounded-[18px] border border-white/40"></div>
            <div class="relative flex h-full flex-col justify-between p-5 text-[#2b2620]">
                <span class="text-[10px] font-semibold uppercase tracking-[0.28em]">{{ strtoupper($item['type']) }}</span>
                <div>
                    <div class="text-2xl font-semibold leading-tight" style="font-family: 'Fraunces', Georgia, serif;">{{ $item['title'] }}</div>
                    <div class="mt-2 text-sm opacity-70">{{ $item['author'] }}</div>
                </div>
            </div>
        @endif
    </div>
@if ($href)
    </a>
@else
    </div>
@endif
