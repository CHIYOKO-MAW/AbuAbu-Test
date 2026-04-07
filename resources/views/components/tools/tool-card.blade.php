@props([
    'tool',
    'compact' => false,
])

<article class="group rounded-[1.6rem] border border-[#2d3629] bg-[linear-gradient(180deg,#1a2019_0%,#151916_100%)] p-5 transition hover:border-[#4d5d45] hover:bg-[#1b211a]">
    <div class="flex items-start justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/10 bg-[#0f130f] font-mono text-sm font-semibold text-white" style="box-shadow: inset 0 0 0 1px {{ $tool['accent'] }}40;">
                {{ $tool['icon'] }}
            </div>
            <div>
                <div class="font-mono text-[11px] uppercase tracking-[0.24em] text-[#8e9a85]">{{ strtoupper($tool['category']) }}</div>
                <div class="mt-1 text-sm text-[#b8c1b0]">{{ $tool['vendor'] }}</div>
            </div>
        </div>
        <div class="rounded-full border border-white/10 px-3 py-1 font-mono text-[11px] uppercase tracking-[0.2em] text-[#aab4a2]">
            v{{ $tool['version'] }}
        </div>
    </div>

    <h3 class="mt-5 text-2xl font-semibold leading-tight text-[#f0f3ec]">
        <a href="{{ route('tools.show', ['slug' => $tool['slug'], 'lang' => request('lang', 'id')]) }}" class="transition group-hover:text-[#d8ff79]">{{ $tool['title'] }}</a>
    </h3>

    <p class="mt-3 text-sm leading-7 text-[#aeb7a8]">{{ $tool['summary'] }}</p>

    <div class="mt-5 flex flex-wrap gap-2">
        @foreach ($tool['tags'] as $tag)
            <a href="{{ route('tools.index', ['lang' => request('lang', 'id'), 'tag' => $tag]) }}" class="rounded-full border border-[#33402d] px-3 py-1 text-[11px] uppercase tracking-[0.2em] text-[#99a38f] transition hover:border-[#5d6b51] hover:text-[#eef2ea]">
                {{ $tag }}
            </a>
        @endforeach
    </div>

    <div class="mt-5 grid gap-3 {{ $compact ? '' : 'sm:grid-cols-3' }}">
        <div class="rounded-2xl border border-[#283024] bg-[#111510] px-3 py-3">
            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">OS</div>
            <div class="mt-2 text-sm text-[#eef2ea]">{{ strtoupper(implode(', ', $tool['os'])) }}</div>
        </div>
        <div class="rounded-2xl border border-[#283024] bg-[#111510] px-3 py-3">
            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Size</div>
            <div class="mt-2 text-sm text-[#eef2ea]">{{ $tool['download']['size'] ?? $tool['filesize'] }}</div>
        </div>
        <div class="rounded-2xl border border-[#283024] bg-[#111510] px-3 py-3">
            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Downloads</div>
            <div class="mt-2 text-sm text-[#eef2ea]">{{ $tool['download_count'] }}</div>
        </div>
    </div>
    <div class="mt-5 flex items-center justify-between gap-4">
        <a href="{{ route('tools.show', ['slug' => $tool['slug'], 'lang' => request('lang', 'id')]) }}" class="font-mono text-xs uppercase tracking-[0.24em] text-[#c9ff4d] transition hover:text-[#e0ff90]">Open package</a>
        <span class="text-xs uppercase tracking-[0.2em] {{ $tool['download']['available'] ? 'text-[#94d37c]' : 'text-[#8a9383]' }}">
            {{ $tool['download']['available'] ? 'ready' : 'pending' }}
        </span>
    </div>
</article>
