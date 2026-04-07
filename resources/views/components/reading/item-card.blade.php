@props([
    'item',
    'lang' => 'id',
    'compact' => false,
])

@php
    $href = route('reading.show', ['type' => $item['type'], 'slug' => $item['slug'], 'lang' => $lang]);
@endphp

<article class="group rounded-[28px] border border-[#dfd3c2] bg-[#fffaf2] p-4 shadow-[0_16px_30px_rgba(74,58,40,0.06)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_34px_rgba(74,58,40,0.10)]">
    <x-reading.cover :item="$item" :href="$href" />

    <div class="mt-4 px-1 pb-1">
        <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
                <a href="{{ $href }}" class="block text-[1.02rem] leading-7 text-[#2b2620] transition group-hover:text-[#50615a]" style="font-family: 'Fraunces', Georgia, serif;">
                    {{ $item['title'] }}
                </a>
                <div class="mt-1 text-[0.94rem] text-[#6f6558]">{{ $item['author'] }}</div>
            </div>
            <span class="rounded-full border border-[#e1d6c7] bg-[#f6efe4] px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.2em] text-[#7d7263]">
                {{ $item['type'] }}
            </span>
        </div>

        <div class="mt-4 grid gap-2 text-xs text-[#7b7061] sm:grid-cols-2">
            <div class="rounded-2xl border border-[#e7ddcf] bg-[#f8f2e8] px-3 py-2">
                <div class="text-[10px] uppercase tracking-[0.24em] text-[#9b8f7f]">Topic</div>
                <div class="mt-1 text-[#433b31]">{{ $item['topic'] }}</div>
            </div>
            <div class="rounded-2xl border border-[#e7ddcf] bg-[#f8f2e8] px-3 py-2">
                <div class="text-[10px] uppercase tracking-[0.24em] text-[#9b8f7f]">Format</div>
                <div class="mt-1 text-[#433b31]">{{ $item['format'] }}</div>
            </div>
        </div>

        @unless ($compact)
            <p class="mt-4 text-sm leading-7 text-[#6d6255]">{{ $item['summary'] }}</p>
        @endunless

        <div class="mt-4 flex items-center justify-between gap-3 text-[11px] uppercase tracking-[0.2em]">
            <span class="text-[#9b8f7f]">Updated {{ \Illuminate\Support\Carbon::parse($item['updated_at'])->format('M j') }}</span>
            <span class="rounded-full px-3 py-1 {{ $item['download']['available'] ? 'bg-[#edf2e8] text-[#47604e]' : 'bg-[#f1ebe1] text-[#8f8373]' }}">
                {{ $item['download']['available'] ? 'download ready' : 'preview only' }}
            </span>
        </div>
    </div>
</article>
