@props([
    'store' => [],
    'lang' => 'en',
    'genres' => [],
    'currentGenre' => 'Featured',
    'currentType' => 'all',
    'currentFormat' => 'all',
    'query' => '',
])

<header class="border-b border-white/8 bg-[linear-gradient(180deg,#15181d_0%,#12151a_100%)] text-[#dce2ea] shadow-[0_18px_60px_rgba(0,0,0,0.24)]">
    <div class="mx-auto max-w-[1460px] px-4 py-4 sm:px-6 lg:px-8">
        <div class="rounded-[30px] border border-white/8 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_24%),radial-gradient(circle_at_top_right,rgba(61,154,233,0.14),transparent_22%),#191d23] p-4 shadow-[inset_0_1px_0_rgba(255,255,255,0.04)] sm:p-5">
            <div class="flex flex-col gap-5 xl:flex-row xl:items-start xl:justify-between">
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-white/42">
                        <span class="rounded-full border border-[#6C5CE7]/30 bg-[#6C5CE7]/10 px-3 py-1 text-[#b9afff]">
                            Audio storefront
                        </span>
                        <span class="rounded-full border border-white/8 px-3 py-1">
                            Licensed catalog
                        </span>
                    </div>

                    <div class="mt-4 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                        <div class="min-w-0">
                            <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="inline-flex items-end gap-3">
                                <div class="font-display text-3xl font-bold tracking-[-0.04em] text-white sm:text-4xl">
                                    ABU-ABU
                                </div>
                                <div class="mb-1 rounded-full border border-[#3d9ae9]/25 bg-[#3d9ae9]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-[#8bcbff]">
                                    Audio Desk
                                </div>
                            </a>
                            <p class="mt-3 max-w-2xl text-sm leading-7 text-white/58">
                                {{ $store['brand']['subtitle'] ?? 'Curated digital music archive' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-white/58 lg:justify-end">
                            @foreach ($store['utility_nav'] as $item)
                                <a href="{{ $item['href'] }}" class="transition hover:text-white">{{ $item['label'] }}</a>
                            @endforeach
                            <x-language-switcher :lang="$lang" />
                        </div>
                    </div>
                </div>

                <div class="w-full xl:max-w-[430px]">
                    <form method="GET" action="{{ route('audio.index') }}" class="rounded-[24px] border border-white/8 bg-[#101318] p-3 shadow-[inset_0_1px_0_rgba(255,255,255,0.03)]">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        @if ($currentGenre !== 'Featured')
                            <input type="hidden" name="genre" value="{{ $currentGenre }}">
                        @endif
                        @if ($currentType !== 'all')
                            <input type="hidden" name="type" value="{{ $currentType }}">
                        @endif
                        @if ($currentFormat !== 'all')
                            <input type="hidden" name="format" value="{{ $currentFormat }}">
                        @endif

                        <div class="flex items-center gap-3">
                            <div class="relative flex-1">
                                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-white/28">Q</span>
                                <input
                                    type="text"
                                    name="q"
                                    value="{{ $query }}"
                                    placeholder="Search artist, album, or release"
                                    class="h-12 w-full rounded-2xl border border-white/8 bg-[#1c2128] pl-11 pr-4 text-sm text-white placeholder:text-white/35 focus:border-[#3d9ae9]/70 focus:outline-none"
                                >
                            </div>
                            <button class="h-12 rounded-2xl bg-[#3d9ae9] px-5 text-sm font-semibold text-white transition hover:bg-[#52a8f0]">
                                Search
                            </button>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2 text-[11px] uppercase tracking-[0.24em] text-white/38">
                            <span class="rounded-full border border-white/8 px-3 py-1">Fast scan</span>
                            <span class="rounded-full border border-white/8 px-3 py-1">Artist index</span>
                            <span class="rounded-full border border-white/8 px-3 py-1">Genre shelves</span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-5 grid gap-3 xl:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-[24px] border border-white/8 bg-[#14181e] p-4">
                    <div class="mb-3 text-[11px] font-semibold uppercase tracking-[0.3em] text-white/38">Browse releases</div>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach ($store['browse_tabs'] as $tab)
                            <a
                                href="{{ route('audio.index', array_filter(['lang' => $lang, 'type' => $tab['value'] !== 'all' ? $tab['value'] : null, 'genre' => $currentGenre !== 'Featured' ? $currentGenre : null, 'format' => $currentFormat !== 'all' ? $currentFormat : null, 'q' => $query !== '' ? $query : null])) }}"
                                class="rounded-full border px-4 py-2 text-sm transition {{ $currentType === $tab['value'] ? 'border-[#6C5CE7]/40 bg-[#6C5CE7]/14 text-[#d5cfff]' : 'border-white/8 bg-white/[0.02] text-white/60 hover:text-white' }}"
                            >
                                {{ $tab['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-[24px] border border-white/8 bg-[#14181e] p-4">
                    <div class="mb-3 text-[11px] font-semibold uppercase tracking-[0.3em] text-white/38">File format</div>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach ($store['format_tabs'] as $tab)
                            <a
                                href="{{ route('audio.index', array_filter(['lang' => $lang, 'format' => $tab['value'] !== 'all' ? $tab['value'] : null, 'genre' => $currentGenre !== 'Featured' ? $currentGenre : null, 'type' => $currentType !== 'all' ? $currentType : null, 'q' => $query !== '' ? $query : null])) }}"
                                class="rounded-full border px-4 py-2 text-sm transition {{ $currentFormat === $tab['value'] ? 'border-[#00B894]/35 bg-[#00B894]/12 text-[#96ead8]' : 'border-white/8 bg-white/[0.02] text-white/60 hover:text-white' }}"
                            >
                                {{ $tab['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-3 rounded-[24px] border border-white/8 bg-[#14181e] p-4">
                <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/38">Genre navigator</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($genres as $genre)
                            <a
                                href="{{ route('audio.index', array_filter(['lang' => $lang, 'genre' => $genre !== 'Featured' ? $genre : null, 'type' => $currentType !== 'all' ? $currentType : null, 'format' => $currentFormat !== 'all' ? $currentFormat : null, 'q' => $query !== '' ? $query : null])) }}"
                                class="rounded-full px-3 py-1.5 text-sm transition {{ $currentGenre === $genre ? 'bg-[#FDCB6E]/14 text-[#f2d797]' : 'text-white/58 hover:bg-white/[0.04] hover:text-white' }}"
                            >
                                {{ $genre }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
