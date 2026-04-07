@props([
    'href' => '#',
    'title' => null,
    'description' => null,
    'meta' => null,
    'accent' => 'violet',
    'icon' => 'AA',
])

@php
    $accentMap = [
        'violet' => 'from-[#6C5CE7]/18 to-[#6C5CE7]/5',
        'teal' => 'from-[#00B894]/18 to-[#00B894]/5',
        'amber' => 'from-[#FDCB6E]/18 to-[#FDCB6E]/5',
        'rose' => 'from-[#FF7A90]/18 to-[#FF7A90]/5',
    ];

    $dotMap = [
        'violet' => 'bg-[#6C5CE7]',
        'teal' => 'bg-[#00B894]',
        'amber' => 'bg-[#FDCB6E]',
        'rose' => 'bg-[#FF7A90]',
    ];

    $accentClass = $accentMap[$accent] ?? $accentMap['violet'];
    $dotClass = $dotMap[$accent] ?? $dotMap['violet'];
@endphp

<a
    href="{{ $href }}"
    class="group relative flex h-full flex-col justify-between overflow-hidden rounded-3xl border border-white/10 bg-white/[0.04] p-6 shadow-[0_20px_60px_rgba(0,0,0,0.22)] transition duration-300 hover:-translate-y-1 hover:border-white/20 hover:bg-white/[0.06]"
>
    <div class="pointer-events-none absolute inset-0 opacity-0 transition group-hover:opacity-100">
        <div class="h-full w-full bg-gradient-to-br {{ $accentClass }}"></div>
    </div>

    <div class="relative">
        <div class="flex items-center justify-between gap-3">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-black/20 font-display text-sm font-bold tracking-[0.2em] text-white">
                {{ $icon }}
            </span>

            @if ($meta)
                <span class="rounded-full border border-white/10 bg-white/[0.03] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.25em] text-[#A0A3BD]">
                    {{ $meta }}
                </span>
            @endif
        </div>

        <h3 class="mt-6 font-display text-2xl font-bold tracking-tight text-white">
            {{ $title }}
        </h3>

        <p class="mt-3 text-sm leading-7 text-[#A0A3BD]">
            {{ $description }}
        </p>
    </div>

    <div class="relative mt-6 flex items-center justify-between text-sm font-semibold text-[#EAEAF0]">
        <span class="inline-flex items-center gap-2">
            <span class="h-2.5 w-2.5 rounded-full {{ $dotClass }}"></span>
            Explore shelf
        </span>
        <span class="transition group-hover:translate-x-1">→</span>
    </div>
</a>
