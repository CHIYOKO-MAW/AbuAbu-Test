@props([
    'title' => 'Nothing matched',
    'copy' => 'Try changing the current filters.',
    'tone' => 'dark',
])

@php
    $toneClasses = match ($tone) {
        'paper' => 'border-[#ddd1c1] bg-[#fbf7ef] text-[#7a6f62]',
        'tools' => 'border-[#2d3728] bg-[#111510] text-[#9aa48f]',
        default => 'border-white/8 bg-[#20252c] text-white/55',
    };
@endphp

<div {{ $attributes->merge(['class' => 'rounded-[28px] border px-6 py-10 text-center '.$toneClasses]) }}>
    <div class="text-base font-semibold">{{ $title }}</div>
    <p class="mt-2 text-sm leading-7 opacity-80">{{ $copy }}</p>
</div>
