@props([
    'items' => [],
    'lang' => 'id',
    'current' => null,
    'accent' => 'violet',
])

@php
    $accentStyles = [
        'violet' => 'border-[#6C5CE7]/25 bg-[#6C5CE7]/10 text-white',
        'paper' => 'border-[#E8DCC1]/25 bg-[#E8DCC1]/10 text-white',
        'wave' => 'border-[#FF4FD8]/25 bg-[#FF4FD8]/10 text-white',
        'terminal' => 'border-[#3DBF79]/25 bg-[#3DBF79]/10 text-white',
        'control' => 'border-[#F6B26B]/25 bg-[#F6B26B]/10 text-white',
    ];

    $currentClass = $accentStyles[$accent] ?? $accentStyles['violet'];
@endphp

<div class="flex flex-wrap gap-2">
    @foreach ($items as $item)
        @php
            $label = \App\Support\AbuAbu::text($item['label'], $lang);
            $isCurrent = $current && ($current === $item['href'] || $current === ($item['slug'] ?? null));
        @endphp
        <a
            href="{{ $item['href'] }}"
            class="rounded-full border px-4 py-2 text-sm font-semibold transition {{ $isCurrent ? $currentClass : 'border-white/10 bg-white/[0.03] text-[#A0A3BD] hover:border-white/20 hover:bg-white/[0.06] hover:text-white' }}"
        >
            {{ $label }}
        </a>
    @endforeach
</div>
