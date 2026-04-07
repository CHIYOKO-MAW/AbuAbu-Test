@props([
    'href' => '#',
    'title' => null,
    'description' => null,
    'meta' => null,
    'tag' => null,
    'accent' => 'violet',
])

@php
    $accentMap = [
        'violet' => 'border-[#6C5CE7]/30 bg-[#6C5CE7]/8',
        'teal' => 'border-[#00B894]/30 bg-[#00B894]/8',
        'amber' => 'border-[#FDCB6E]/30 bg-[#FDCB6E]/8',
        'rose' => 'border-[#FF7A90]/30 bg-[#FF7A90]/8',
    ];

    $accentClass = $accentMap[$accent] ?? $accentMap['violet'];
@endphp

<a
    href="{{ $href }}"
    class="group flex h-full flex-col rounded-3xl border border-white/10 bg-white/[0.04] p-6 transition duration-300 hover:-translate-y-1 hover:border-white/20 hover:bg-white/[0.06]"
>
    <div class="flex items-center justify-between gap-3">
        @if ($tag)
            <span class="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.25em] text-[#A0A3BD]">
                {{ $tag }}
            </span>
        @else
            <span></span>
        @endif

        @if ($meta)
            <span class="text-xs text-[#A0A3BD]">{{ $meta }}</span>
        @endif
    </div>

    <h3 class="mt-6 font-display text-xl font-bold tracking-tight text-white">
        {{ $title }}
    </h3>

    <p class="mt-3 text-sm leading-7 text-[#A0A3BD]">
        {{ $description }}
    </p>

    <div class="mt-6 flex items-center gap-3">
        <span class="h-2.5 w-2.5 rounded-full {{ $accentClass }}"></span>
        <span class="text-sm font-semibold text-[#EAEAF0]">Ready in the shell</span>
    </div>
</a>
