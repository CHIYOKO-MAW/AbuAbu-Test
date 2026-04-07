@props(['lang' => 'id'])

@php
    $current = $lang === 'en' ? 'en' : 'id';
    $other = $current === 'id' ? 'en' : 'id';
@endphp

<div class="inline-flex items-center rounded-full border border-white/10 bg-white/[0.03] p-1">
    <a
        href="{{ request()->fullUrlWithQuery(['lang' => 'id']) }}"
        class="rounded-full px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] transition {{ $current === 'id' ? 'bg-white text-[#0F1115]' : 'text-[#A0A3BD] hover:text-white' }}"
    >
        ID
    </a>
    <a
        href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}"
        class="rounded-full px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.25em] transition {{ $current === 'en' ? 'bg-white text-[#0F1115]' : 'text-[#A0A3BD] hover:text-white' }}"
    >
        EN
    </a>
</div>
