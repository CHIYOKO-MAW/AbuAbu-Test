@props([
    'store' => [],
    'lang' => 'id',
    'currentQuery' => '',
    'currentType' => 'all',
    'currentTopic' => 'All topics',
    'currentSort' => 'latest',
])

<header class="border-b border-[#d9cebf] bg-[#f7f2e8] text-[#2b2620]">
    <div class="mx-auto max-w-[1460px] px-4 pt-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#e3d8ca] pb-4 text-[11px] font-semibold uppercase tracking-[0.28em] text-[#7f7364]">
            <div class="flex flex-wrap items-center gap-3">
                <span>Reading room</span>
                <span class="h-1 w-1 rounded-full bg-[#b9ab98]"></span>
                <span>{{ $store['brand']['subtitle'] ?? 'Editorial library for journals, ebooks, and long-form notes.' }}</span>
            </div>

            <div class="inline-flex items-center rounded-full border border-[#d7cab6] bg-white/70 p-1">
                <a
                    href="{{ request()->fullUrlWithQuery(['lang' => 'id']) }}"
                    class="rounded-full px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.24em] transition {{ $lang === 'id' ? 'bg-[#2b2620] text-[#f8f3ea]' : 'text-[#7e7365] hover:text-[#2b2620]' }}"
                >
                    ID
                </a>
                <a
                    href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}"
                    class="rounded-full px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.24em] transition {{ $lang === 'en' ? 'bg-[#2b2620] text-[#f8f3ea]' : 'text-[#7e7365] hover:text-[#2b2620]' }}"
                >
                    EN
                </a>
            </div>
        </div>

        <div class="grid gap-6 py-6 xl:grid-cols-[1fr_auto_1fr] xl:items-center">
            <nav class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-[#716558]">
                @foreach ($store['utility_nav'] as $item)
                    <a href="{{ $item['href'] }}" class="transition hover:text-[#2b2620]">{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <div class="text-center">
                <a href="{{ route('reading.index', ['lang' => $lang]) }}" class="inline-block">
                    <div class="text-4xl font-semibold tracking-[-0.05em] text-[#2b2620] sm:text-5xl" style="font-family: 'Fraunces', Georgia, serif;">
                        ABU-ABU READING
                    </div>
                    <div class="mt-2 text-[11px] font-semibold uppercase tracking-[0.34em] text-[#8d8172]">
                        Editorial Library
                    </div>
                </a>
            </div>

            <form method="GET" action="{{ route('reading.index') }}" class="justify-self-stretch xl:justify-self-end xl:w-full xl:max-w-[380px]">
                <input type="hidden" name="lang" value="{{ $lang }}">
                @if ($currentType !== 'all')
                    <input type="hidden" name="type" value="{{ $currentType }}">
                @endif
                @if ($currentTopic !== 'All topics')
                    <input type="hidden" name="topic" value="{{ $currentTopic }}">
                @endif
                @if ($currentSort !== 'latest')
                    <input type="hidden" name="sort" value="{{ $currentSort }}">
                @endif

                <div class="flex items-center gap-2">
                    <div class="relative flex-1">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-[#8b7d6d]">Q</span>
                        <input
                            type="text"
                            name="q"
                            value="{{ $currentQuery }}"
                            placeholder="Search title, author, or topic"
                            class="h-12 w-full rounded-full border border-[#d8cdbc] bg-[#fffaf2] pl-11 pr-4 text-sm text-[#2b2620] placeholder:text-[#938475] focus:border-[#93a489] focus:outline-none"
                        >
                    </div>
                    <button class="h-12 rounded-full bg-[#2f4f4f] px-5 text-sm font-semibold text-[#f8f3ea] transition hover:bg-[#3c6464]">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-col gap-4 border-t border-[#e3d8ca] py-4 lg:flex-row lg:items-start lg:justify-between">
            <div class="max-w-2xl">
                <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">{{ $store['hero']['eyebrow'] }}</div>
                <p class="mt-3 text-sm leading-7 text-[#6d6256]">{{ $store['hero']['copy'] }}</p>
            </div>

            <div class="grid gap-3 lg:min-w-[720px] lg:grid-cols-3">
                <div class="border-l border-[#d9cebf] pl-4">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8e816f]">Type</div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($store['type_tabs'] as $tab)
                            <a
                                href="{{ route('reading.index', array_filter(['lang' => $lang, 'type' => $tab['value'] !== 'all' ? $tab['value'] : null, 'topic' => $currentTopic !== 'All topics' ? $currentTopic : null, 'sort' => $currentSort !== 'latest' ? $currentSort : null, 'q' => $currentQuery !== '' ? $currentQuery : null])) }}"
                                class="text-sm transition {{ $currentType === $tab['value'] ? 'text-[#2b2620] underline decoration-[#a5967f] underline-offset-4' : 'text-[#75695d] hover:text-[#2b2620]' }}"
                            >
                                {{ $tab['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="border-l border-[#d9cebf] pl-4">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8e816f]">Topic</div>
                    <div class="mt-3 flex flex-wrap gap-x-3 gap-y-1">
                        @foreach ($store['topic_tabs'] as $tab)
                            <a
                                href="{{ route('reading.index', array_filter(['lang' => $lang, 'topic' => $tab !== 'All topics' ? $tab : null, 'type' => $currentType !== 'all' ? $currentType : null, 'sort' => $currentSort !== 'latest' ? $currentSort : null, 'q' => $currentQuery !== '' ? $currentQuery : null])) }}"
                                class="text-sm transition {{ $currentTopic === $tab ? 'text-[#2b2620] underline decoration-[#97a48b] underline-offset-4' : 'text-[#75695d] hover:text-[#2b2620]' }}"
                            >
                                {{ $tab }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="border-l border-[#d9cebf] pl-4">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8e816f]">Sort</div>
                    <div class="mt-3 flex flex-wrap gap-3">
                        @foreach ($store['sort_tabs'] as $tab)
                            <a
                                href="{{ route('reading.index', array_filter(['lang' => $lang, 'sort' => $tab['value'] !== 'latest' ? $tab['value'] : null, 'type' => $currentType !== 'all' ? $currentType : null, 'topic' => $currentTopic !== 'All topics' ? $currentTopic : null, 'q' => $currentQuery !== '' ? $currentQuery : null])) }}"
                                class="text-sm transition {{ $currentSort === $tab['value'] ? 'text-[#2b2620] underline decoration-[#97a48b] underline-offset-4' : 'text-[#75695d] hover:text-[#2b2620]' }}"
                            >
                                {{ $tab['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
