@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'align' => 'left',
])

@php
    $alignClass = $align === 'center' ? 'text-center items-center' : 'text-left items-start';
@endphp

<div class="flex flex-col gap-3 {{ $alignClass }}">
    @if ($eyebrow)
        <p class="inline-flex rounded-full border border-white/10 bg-white/[0.04] px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#A0A3BD]">
            {{ $eyebrow }}
        </p>
    @endif

    @if ($title)
        <h2 class="font-display text-3xl font-bold tracking-tight text-white sm:text-4xl">
            {{ $title }}
        </h2>
    @endif

    @if ($description)
        <p class="max-w-3xl text-sm leading-7 text-[#A0A3BD] sm:text-base">
            {{ $description }}
        </p>
    @endif
</div>
