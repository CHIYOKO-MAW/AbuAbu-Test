@props([
    'article',
    'lang' => 'id',
])

<article class="rounded-[1.5rem] border border-[#2b3426] bg-[#161b15] p-5">
    <div class="font-mono text-[11px] uppercase tracking-[0.24em] text-[#94a089]">{{ $article['product'] }}</div>
    <a href="{{ route('tools.help', ['slug' => $article['slug'], 'lang' => $lang]) }}" class="mt-3 block text-xl font-semibold leading-tight text-[#eef2ea] transition hover:text-[#d8ff79]">
        {{ $article['title'] }}
    </a>
    <p class="mt-3 text-sm leading-7 text-[#aeb7a8]">{{ $article['summary'] }}</p>
    <div class="mt-4 font-mono text-xs uppercase tracking-[0.22em] text-[#c9ff4d]">Open recovery note</div>
</article>
