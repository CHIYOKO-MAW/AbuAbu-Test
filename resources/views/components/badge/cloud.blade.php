@props([
    'name' => null,
    'status' => null,
    'accent' => 'violet',
])

@php
    $accentMap = [
        'violet' => 'bg-[#6C5CE7]',
        'teal' => 'bg-[#00B894]',
        'amber' => 'bg-[#FDCB6E]',
        'rose' => 'bg-[#FF7A90]',
    ];

    $dotClass = $accentMap[$accent] ?? $accentMap['violet'];
@endphp

<span class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/[0.04] px-4 py-2 text-sm text-[#EAEAF0]">
    <span class="h-2.5 w-2.5 rounded-full {{ $dotClass }}"></span>
    <span class="font-semibold">{{ $name }}</span>
    @if ($status)
        <span class="text-[#A0A3BD]">{{ $status }}</span>
    @endif
</span>
