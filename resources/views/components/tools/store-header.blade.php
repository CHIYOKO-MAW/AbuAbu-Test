@props([
    'store' => [],
    'lang' => 'id',
    'currentQuery' => '',
    'currentCategory' => 'all',
    'currentOs' => 'all',
    'currentTag' => 'all',
    'currentSort' => 'featured',
])

<header class="border-b border-[#2c3528] bg-[linear-gradient(180deg,#151914_0%,#121512_100%)] text-[#eef2ea]">
    <div class="mx-auto max-w-[1460px] px-4 pt-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#293124] pb-4 text-[11px] uppercase tracking-[0.24em] text-[#9ba58f]">
            <div class="flex flex-wrap items-center gap-3">
                <span>Workshop console</span>
                <span class="h-1 w-1 rounded-full bg-[#c9ff4d]"></span>
                <span>{{ $store['brand']['subtitle'] ?? 'Legal utilities and recovery notes.' }}</span>
            </div>

            <div class="inline-flex items-center rounded-full border border-[#374132] bg-[#171c16] p-1">
                <a href="{{ request()->fullUrlWithQuery(['lang' => 'id']) }}" class="rounded-full px-3 py-1.5 text-xs font-semibold {{ $lang === 'id' ? 'bg-[#c9ff4d] text-[#11140f]' : 'text-[#96a18a]' }}">ID</a>
                <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" class="rounded-full px-3 py-1.5 text-xs font-semibold {{ $lang === 'en' ? 'bg-[#c9ff4d] text-[#11140f]' : 'text-[#96a18a]' }}">EN</a>
            </div>
        </div>

        <div class="grid gap-6 py-6 xl:grid-cols-[1fr_auto_1fr] xl:items-center">
            <nav class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-[#92a08b]">
                @foreach ($store['utility_nav'] as $item)
                    <a href="{{ $item['href'] }}" class="transition hover:text-[#eef2ea]">{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <div class="text-center">
                <a href="{{ route('tools.index', ['lang' => $lang]) }}" class="inline-block">
                    <div class="font-display text-4xl font-bold tracking-[-0.05em] text-[#eef2ea] sm:text-5xl">ABU-ABU TOOLS</div>
                    <div class="mt-2 font-mono text-[11px] uppercase tracking-[0.34em] text-[#a3ae96]">Workshop Console</div>
                </a>
            </div>

            <form method="GET" action="{{ route('tools.index') }}" class="justify-self-stretch xl:justify-self-end xl:w-full xl:max-w-[430px]">
                <input type="hidden" name="lang" value="{{ $lang }}">
                @if ($currentCategory !== 'all')
                    <input type="hidden" name="category" value="{{ $currentCategory }}">
                @endif
                @if ($currentOs !== 'all')
                    <input type="hidden" name="os" value="{{ $currentOs }}">
                @endif
                @if ($currentTag !== 'all')
                    <input type="hidden" name="tag" value="{{ $currentTag }}">
                @endif
                @if ($currentSort !== 'featured')
                    <input type="hidden" name="sort" value="{{ $currentSort }}">
                @endif

                <div class="flex items-center gap-2">
                    <div class="relative flex-1">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 font-mono text-sm text-[#a5b19b]">&gt;_</span>
                        <input
                            type="text"
                            name="q"
                            value="{{ $currentQuery }}"
                            placeholder="Search title, vendor, tag, or OS"
                            class="h-12 w-full rounded-2xl border border-[#313b2d] bg-[#181d18] pl-14 pr-4 text-sm text-[#eef2ea] placeholder:text-[#82907b] focus:border-[#c9ff4d] focus:outline-none"
                        >
                    </div>
                    <button class="h-12 rounded-2xl bg-[#c9ff4d] px-5 text-sm font-semibold text-[#11140f] transition hover:bg-[#d6ff6d]">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="grid gap-4 border-t border-[#293124] py-4 lg:grid-cols-[1.2fr_1fr_1fr]">
            <div>
                <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#97a38b]">Console brief</div>
                <p class="mt-3 max-w-2xl text-sm leading-7 text-[#aeb8a4]">{{ $store['hero']['copy'] }}</p>
            </div>

            <div class="border-l border-[#293124] pl-4">
                <div class="font-mono text-[11px] uppercase tracking-[0.28em] text-[#97a38b]">Category</div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($store['category_tabs'] as $tab)
                        <a
                            href="{{ route('tools.index', array_filter(['lang' => $lang, 'category' => $tab['value'] !== 'all' ? $tab['value'] : null, 'os' => $currentOs !== 'all' ? $currentOs : null, 'tag' => $currentTag !== 'all' ? $currentTag : null, 'sort' => $currentSort !== 'featured' ? $currentSort : null, 'q' => $currentQuery !== '' ? $currentQuery : null])) }}"
                            class="rounded-full border px-3 py-1 text-xs uppercase tracking-[0.18em] transition {{ $currentCategory === $tab['value'] ? 'border-[#c9ff4d] bg-[#c9ff4d] text-[#11140f]' : 'border-[#394333] text-[#9ca795] hover:border-[#5c6b53] hover:text-[#eef2ea]' }}"
                        >
                            {{ $tab['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="border-l border-[#293124] pl-4">
                <div class="font-mono text-[11px] uppercase tracking-[0.28em] text-[#97a38b]">Platform / sort</div>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($store['os_tabs'] as $tab)
                        <a
                            href="{{ route('tools.index', array_filter(['lang' => $lang, 'os' => $tab['value'] !== 'all' ? $tab['value'] : null, 'category' => $currentCategory !== 'all' ? $currentCategory : null, 'tag' => $currentTag !== 'all' ? $currentTag : null, 'sort' => $currentSort !== 'featured' ? $currentSort : null, 'q' => $currentQuery !== '' ? $currentQuery : null])) }}"
                            class="rounded-full border px-3 py-1 text-xs uppercase tracking-[0.18em] transition {{ $currentOs === $tab['value'] ? 'border-[#f5b041] bg-[#f5b041] text-[#11140f]' : 'border-[#394333] text-[#9ca795] hover:border-[#5c6b53] hover:text-[#eef2ea]' }}"
                        >
                            {{ $tab['label'] }}
                        </a>
                    @endforeach
                </div>
                <div class="mt-3 flex flex-wrap gap-3 text-xs uppercase tracking-[0.18em] text-[#8f9a85]">
                    @foreach ($store['sort_tabs'] as $tab)
                        <a
                            href="{{ route('tools.index', array_filter(['lang' => $lang, 'sort' => $tab['value'] !== 'featured' ? $tab['value'] : null, 'category' => $currentCategory !== 'all' ? $currentCategory : null, 'os' => $currentOs !== 'all' ? $currentOs : null, 'tag' => $currentTag !== 'all' ? $currentTag : null, 'q' => $currentQuery !== '' ? $currentQuery : null])) }}"
                            class="transition {{ $currentSort === $tab['value'] ? 'text-[#eef2ea] underline decoration-[#c9ff4d] underline-offset-4' : 'hover:text-[#eef2ea]' }}"
                        >
                            {{ $tab['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>
