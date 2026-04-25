@php
    use App\Support\AbuAbu;
    use App\Support\HomeStore;

    $site = $site ?? config('abuabu.site');
    $lang = AbuAbu::lang($lang ?? request('lang'));
    $homeView = $homeView ?? HomeStore::viewModel($lang);
    $brand = $homeView['brand'];
    $home = $homeView['home'];
    $navigation = $homeView['navigation'];
    $doors = $homeView['doors'];
@endphp

<header class="fixed inset-x-0 top-0 z-50 px-4 pt-4 sm:px-6 lg:px-8">
    <div class="aa-home-shell mx-auto max-w-[1380px]">
        <div class="grid gap-4 px-4 py-4 md:grid-cols-[auto_1fr_auto] md:items-center sm:px-6">
            <a href="{{ route('home', ['lang' => $lang]) }}" class="aa-focus flex items-center gap-4">
                <span
                    class="flex h-11 w-11 items-center justify-center border border-[#2a2e36] bg-[#12151b] font-display text-lg font-bold tracking-[0.18em] text-[#f2f2f2]">
                    AA
                </span>
                <span class="flex flex-col">
                    <span
                        class="font-display text-lg font-bold tracking-[0.12em] text-white">{{ $brand['name'] ?? config('abuabu.brand.name') }}</span>
                    <span
                        class="text-[11px] uppercase tracking-[0.28em] text-[#7f8798]">{{ AbuAbu::text($brand['tagline'] ?? config('abuabu.brand.tagline'), $lang) }}</span>
                </span>
            </a>

            <nav class="hidden flex-wrap items-center justify-center gap-x-6 gap-y-2 md:flex">
                @foreach ($navigation as $item)
                    <a href="{{ $item['url'] }}"
                        class="aa-focus text-[12px] uppercase tracking-[0.28em] text-[#8f97a9] transition hover:text-white">
                        {{ AbuAbu::text($item['label'], $lang) }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden items-center justify-end md:flex">
                <div class="inline-flex items-center border border-[#272b33] bg-[#11141a] p-1">
                    <a href="{{ request()->fullUrlWithQuery(['lang' => 'id']) }}"
                        class="aa-focus px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.24em] {{ $lang === 'id' ? 'bg-[#d8d2c5] text-[#0f1115]' : 'text-[#8992a5]' }}">
                        ID
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}"
                        class="aa-focus px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.24em] {{ $lang === 'en' ? 'bg-[#d8d2c5] text-[#0f1115]' : 'text-[#8992a5]' }}">
                        EN
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="relative overflow-hidden px-4 pb-24 pt-28 sm:px-6 lg:px-8">
    <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[56rem] overflow-hidden">
        <div class="absolute left-[-8rem] top-16 h-80 w-80 rounded-full bg-[#302244]/18 blur-3xl"></div>
        <div class="absolute right-[-4rem] top-28 h-72 w-72 rounded-full bg-[#3b2616]/12 blur-3xl"></div>
        <div class="absolute left-[30%] top-60 h-96 w-96 rounded-full bg-[#1a251d]/12 blur-3xl"></div>
        <div class="absolute inset-x-[18%] top-8 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent">
        </div>
        <div class="absolute left-[8%] top-40 h-[28rem] w-px bg-gradient-to-b from-white/16 via-white/4 to-transparent">
        </div>
        <div
            class="absolute right-[11%] top-56 h-[24rem] w-px bg-gradient-to-b from-white/14 via-white/4 to-transparent">
        </div>
        <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-black/25 to-transparent"></div>
    </div>

    <div class="mx-auto max-w-[1380px]">
        <section class="grid gap-6 lg:grid-cols-[180px_minmax(0,1fr)_320px] lg:items-start">
            <aside class="aa-home-panel order-2 p-5 lg:order-1 lg:sticky lg:top-28">
                <div class="aa-home-kicker">
                    {{ $lang === 'id' ? 'Koordinat' : 'Coordinates' }}
                </div>
                <div class="mt-5 space-y-5">
                    <div>
                        <div class="text-[10px] uppercase tracking-[0.24em] text-[#707b95]">Entry</div>
                        <div class="mt-2 font-display text-3xl text-white">04</div>
                    </div>
                    <div>
                        <div class="text-[10px] uppercase tracking-[0.24em] text-[#707b95]">State</div>
                        <div class="mt-2 text-sm leading-7 text-[#c2c7d7]">
                            {{ $lang === 'id' ? 'Arsip terbuka, tapi tidak semuanya berbicara keras.' : 'The archive is open, but not everything speaks loudly.' }}
                        </div>
                    </div>
                    <div class="aa-home-card p-4">
                        <div class="text-[10px] uppercase tracking-[0.24em] text-[#7f8aa4]">Signal</div>
                        <div class="mt-4 h-px bg-white/10"></div>
                        <div class="mt-4 text-xs leading-6 text-[#dde2ee]">
                            {{ $lang === 'id' ? 'empat pintu tetap jelas, sisanya dibiarkan samar' : 'four doors remain clear, the rest is allowed to stay vague' }}
                        </div>
                    </div>
                </div>
            </aside>

            <section class="order-1 min-w-0 lg:order-2">
                <div
                    class="inline-flex items-center gap-3 border border-[#252932] bg-[#0d1015] px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9aa1b6]">
                    <span>{{ AbuAbu::text($home['hero']['eyebrow'], $lang) }}</span>
                    <span class="h-1.5 w-1.5 rounded-full bg-[#93806f]"></span>
                    <span>{{ strtoupper($lang) }}</span>
                </div>

                <h1
                    class="mt-8 max-w-5xl font-display text-5xl font-bold leading-[0.98] text-white sm:text-6xl lg:text-[93px]">
                    {{ AbuAbu::text($home['hero']['title'], $lang) }}
                </h1>

                <div class="mt-8 grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                    <p class="max-w-2xl text-base leading-8 text-[#aab0c3] sm:text-lg">
                        {{ AbuAbu::text($home['hero']['lead'], $lang) }}
                    </p>

                    <div class="aa-home-panel p-5">
                        <div class="aa-home-kicker">
                            {{ $lang === 'id' ? 'Catatan masuk' : 'Entry note' }}
                        </div>
                        <div class="mt-4 text-lg font-semibold text-white">
                            {{ AbuAbu::text($home['hero']['aside_title'], $lang) }}
                        </div>
                        <div class="mt-4 text-sm leading-7 text-[#c1c7d8]">
                            {{ AbuAbu::text($home['hero']['aside_copy'], $lang) }}
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-wrap gap-3">
                    <a href="#doors"
                        class="aa-focus aa-home-action border-[#d8d2c5] bg-[#d8d2c5] text-[#11131a] hover:bg-white">
                        {{ AbuAbu::text($home['hero']['primary_cta'], $lang) }}
                    </a>
                    <a href="{{ route('audio.index', ['lang' => $lang]) }}"
                        class="aa-focus aa-home-action border-[#252932] bg-[#0d1015] text-[#ececf1] hover:border-[#3a404d] hover:bg-[#11151b]">
                        {{ AbuAbu::text($home['hero']['secondary_cta'], $lang) }}
                    </a>
                </div>
            </section>

            <aside class="aa-home-panel order-3 p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="aa-home-kicker">
                            {{ $lang === 'id' ? 'Jendela sinyal' : 'Signal window' }}
                        </div>
                        <div class="mt-3 font-display text-2xl font-bold text-white">
                            {{ $lang === 'id' ? 'Fragmen yang sedang hidup.' : 'Fragments currently alive.' }}
                        </div>
                    </div>
                    <div class="inline-flex items-center border border-[#272b33] bg-[#11141a] p-1">
                        <a href="{{ request()->fullUrlWithQuery(['lang' => 'id']) }}"
                            class="aa-focus px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.24em] {{ $lang === 'id' ? 'bg-[#d8d2c5] text-[#0f1115]' : 'text-[#8992a5]' }}">
                            ID
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}"
                            class="aa-focus px-3 py-1.5 text-[11px] font-semibold uppercase tracking-[0.24em] {{ $lang === 'en' ? 'bg-[#d8d2c5] text-[#0f1115]' : 'text-[#8992a5]' }}">
                            EN
                        </a>
                    </div>
                </div>

                <div class="mt-6 space-y-3">
                    @foreach ($home['hero']['aside_notes'] as $note)
                        <div class="aa-home-card px-4 py-4 text-sm leading-7 text-[#e4e8f0]">
                            {{ AbuAbu::text($note, $lang) }}
                        </div>
                    @endforeach
                </div>
            </aside>
        </section>

        <section id="doors" class="mt-24">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <p class="aa-home-kicker">
                        {{ $lang === 'id' ? 'Empat jalur masuk' : 'Four access paths' }}
                    </p>
                    <h2 class="mt-3 max-w-3xl font-display text-3xl font-bold text-white sm:text-4xl">
                        {{ $lang === 'id' ? 'Tidak semua rak dibuka dengan cara yang sama.' : 'Not every shelf opens the same way.' }}
                    </h2>
                </div>
            </div>

            <div class="mt-8 grid gap-5 lg:grid-cols-12">
                @foreach ($doors as $door)
                    <a href="{{ $door['url'] }}"
                        class="aa-focus group relative overflow-hidden border border-[#23262e] bg-[#0d1014] p-6 transition duration-300 hover:-translate-y-1 hover:border-[#373d49] hover:bg-[#11151a] {{ $door['frame'] }}">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $door['wash'] }} opacity-55"></div>
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-black/45 to-transparent">
                        </div>
                        <div
                            class="absolute right-6 top-6 font-display text-6xl font-bold text-white/6 transition duration-300 group-hover:text-white/10">
                            {{ $door['number'] }}
                        </div>
                        <div
                            class="absolute left-0 top-10 hidden -translate-x-[42%] -rotate-90 text-[10px] uppercase tracking-[0.5em] text-white/18 lg:block">
                            archive entry
                        </div>
                        <div
                            class="absolute inset-x-6 top-0 h-px bg-gradient-to-r from-transparent via-white/12 to-transparent">
                        </div>

                        <div class="relative flex h-full flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between gap-3">
                                    <span
                                        class="border border-[#252932] bg-[#0a0d11] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.24em] text-[#aeb4c7]">
                                        {{ AbuAbu::text($door['meta'], $lang) }}
                                    </span>
                                    <span class="text-sm text-white/55">{{ AbuAbu::text($door['note'], $lang) }}</span>
                                </div>

                                <h3 class="mt-12 max-w-md font-display text-4xl font-bold leading-none text-white">
                                    {{ AbuAbu::text($door['title'], $lang) }}
                                </h3>
                                <p class="mt-5 max-w-md text-sm leading-7 text-white/78">
                                    {{ AbuAbu::text($door['description'], $lang) }}
                                </p>
                            </div>

                            <div class="mt-12 flex items-center justify-between text-sm font-semibold text-white">
                                <span>{{ $lang === 'id' ? 'Masuk pelan-pelan' : 'Enter slowly' }}</span>
                                <span class="transition group-hover:translate-x-1">→</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="mt-24">
            <div class="grid gap-5 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="aa-home-panel p-6">
                    <div class="aa-home-kicker">
                        {{ $lang === 'id' ? 'Fragmen arsip' : 'Archive fragments' }}
                    </div>
                    <h2 class="mt-4 font-display text-3xl font-bold text-white">
                        {{ $lang === 'id' ? 'Yang terlihat hanya bagian yang perlu terlihat.' : 'Only the necessary parts remain visible.' }}
                    </h2>
                </div>

                <div class="space-y-4">
                    @foreach ($home['fragments'] as $fragment)
                        <article class="aa-home-card grid gap-4 p-5 sm:grid-cols-[180px_1fr] sm:items-start">
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#9ea6bb]">
                                {{ AbuAbu::text($fragment['title'], $lang) }}
                            </div>
                            <p class="text-sm leading-7 text-[#dde1eb]">
                                {{ AbuAbu::text($fragment['copy'], $lang) }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</main>

<x-footer :brand="$brand" :disclaimer="$home['footer']['disclaimer']" :lang="$lang" />
