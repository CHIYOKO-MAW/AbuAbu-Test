@props([
    'tool',
    'lang' => 'id',
])

<article class="grid gap-4 px-5 py-5 md:grid-cols-[110px_1.5fr_0.95fr_150px] md:items-start">
    <div class="font-mono text-[11px] uppercase tracking-[0.24em] text-[#8d9983]">{{ strtoupper($tool['category']) }}</div>
    <div>
        <a href="{{ route('tools.show', ['slug' => $tool['slug'], 'lang' => $lang]) }}" class="text-xl font-semibold leading-tight text-[#eef2ea] transition hover:text-[#d8ff79]">
            {{ $tool['title'] }}
        </a>
        <div class="mt-2 text-sm text-[#aab3a3]">{{ $tool['vendor'] }} / v{{ $tool['version'] }}</div>
        <p class="mt-3 text-sm leading-7 text-[#aab3a3]">{{ $tool['summary'] }}</p>
        <div class="mt-3 flex flex-wrap gap-2">
            @foreach ($tool['tags'] as $tag)
                <a href="{{ route('tools.index', ['lang' => $lang, 'tag' => $tag]) }}" class="rounded-full border border-[#33402d] px-2.5 py-1 text-[10px] uppercase tracking-[0.2em] text-[#92a08b] hover:border-[#4c5a45] hover:text-[#eef2ea]">
                    {{ $tag }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="text-sm text-[#aeb7a8]">
        <div>{{ strtoupper(implode(', ', $tool['os'])) }}</div>
        <div class="mt-2">{{ $tool['download']['size'] ?? $tool['filesize'] }}</div>
        <div class="mt-2 font-mono text-xs uppercase tracking-[0.2em] text-[#87927e]">{{ $tool['checksum'] }}</div>
    </div>
    <div class="text-sm text-[#aeb7a8] md:text-right">
        <div>{{ \Illuminate\Support\Carbon::parse($tool['updated_at'])->format('M j, Y') }}</div>
        <div class="mt-2 {{ $tool['download']['available'] ? 'text-[#9ee36a]' : 'text-[#8c9685]' }}">
            {{ $tool['download']['available'] ? 'download ready' : 'awaiting archive' }}
        </div>
    </div>
</article>
