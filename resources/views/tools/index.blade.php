@extends('layouts.tools')

@section('title', $pageTitle ?? 'Abu-Abu Tools')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-tools.store-header
        :store="$store"
        :lang="$lang"
        :current-query="$currentQuery"
        :current-category="$currentCategory"
        :current-os="$currentOs"
        :current-tag="$currentTag"
        :current-sort="$currentSort"
    />

    <main class="bg-[linear-gradient(180deg,#121512_0%,#0f120f_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <section class="grid gap-6 xl:grid-cols-[1.2fr_0.8fr]">
                <div id="featured" class="rounded-[1.8rem] border border-[#2b3426] bg-[linear-gradient(180deg,#171d16_0%,#131713_100%)] p-6">
                    <div class="flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#94a089]">Featured utilities</div>
                            <h1 class="mt-3 max-w-4xl text-4xl font-semibold leading-tight text-[#eef2ea] sm:text-5xl">
                                {{ $store['hero']['title'] }}
                            </h1>
                        </div>
                        <div class="grid gap-3 sm:grid-cols-3">
                            @foreach ($store['status_strip'] as $item)
                                <div class="rounded-2xl border border-[#2d3728] bg-[#111510] px-4 py-4 text-right">
                                    <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#87927e]">{{ $item['label'] }}</div>
                                    <div class="mt-2 text-2xl font-semibold text-[#eef2ea]">{{ $item['value'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 lg:grid-cols-2">
                        @foreach ($featuredTools as $tool)
                            <x-tools.tool-card :tool="$tool" />
                        @endforeach
                    </div>
                </div>

                <aside id="recovery" class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#9aa68f]">Activation & recovery</div>
                    <h2 class="mt-3 text-3xl font-semibold text-[#eef2ea]">Help desk rail</h2>
                    <p class="mt-4 text-sm leading-7 text-[#aeb7a8]">
                        Tools stays focused on legal downloads, while this side rail keeps recovery notes close for activation errors, installer failures, and account resets.
                    </p>

                    <div class="mt-6 space-y-4">
                        @foreach ($helpArticles as $article)
                            <x-tools.help-card :article="$article" :lang="$lang" />
                        @endforeach
                    </div>
                </aside>
            </section>

            <section id="games" class="mt-8 rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Games archive</div>
                        <h2 class="mt-3 text-3xl font-semibold text-[#eef2ea]">Release-style game entries</h2>
                        <p class="mt-2 max-w-3xl text-sm leading-7 text-[#aab3a3]">
                            A denser release layout for legal game archives, demos, and DRM-free builds, with system requirements, archive notes, and cleaner setup information.
                        </p>
                    </div>
                    <a href="{{ route('tools.index', ['lang' => $lang, 'category' => 'games']) }}" class="font-mono text-xs uppercase tracking-[0.22em] text-[#c9ff4d] transition hover:text-[#e0ff90]">
                        View game shelf
                    </a>
                </div>

                <div class="mt-6 grid gap-4 lg:grid-cols-3">
                    @foreach ($featuredGames as $game)
                        <article class="rounded-[1.6rem] border border-[#2b3426] bg-[linear-gradient(180deg,#171d16_0%,#121612_100%)] p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-[#0f130f] font-mono text-sm font-semibold text-white" style="box-shadow: inset 0 0 0 1px {{ $game['accent'] }}50;">
                                    {{ $game['icon'] }}
                                </div>
                                <div class="rounded-full border border-[#35402f] px-3 py-1 font-mono text-[11px] uppercase tracking-[0.2em] text-[#aab4a2]">
                                    {{ $game['build_type'] }}
                                </div>
                            </div>
                            <div class="mt-5 font-mono text-[11px] uppercase tracking-[0.24em] text-[#8e9a85]">{{ strtoupper($game['license_state']) }}</div>
                            <a href="{{ route('tools.show', ['slug' => $game['slug'], 'lang' => $lang]) }}" class="mt-3 block text-2xl font-semibold leading-tight text-[#eef2ea] transition hover:text-[#d8ff79]">
                                {{ $game['title'] }}
                            </a>
                            <div class="mt-2 text-sm text-[#aab3a3]">{{ $game['vendor'] }} / {{ $game['version'] }}</div>
                            <p class="mt-4 text-sm leading-7 text-[#aeb7a8]">{{ $game['summary'] }}</p>
                            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl border border-[#2c3528] bg-[#101410] px-3 py-3">
                                    <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Release status</div>
                                    <div class="mt-2 text-sm text-[#eef2ea]">{{ $game['release_status'] }}</div>
                                </div>
                                <div class="rounded-2xl border border-[#2c3528] bg-[#101410] px-3 py-3">
                                    <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Platform</div>
                                    <div class="mt-2 text-sm text-[#eef2ea]">{{ strtoupper(implode(', ', $game['os'])) }}</div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="mt-8 grid gap-8 xl:grid-cols-[1.05fr_0.95fr]">
                <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                    <div class="flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Package table</div>
                            <h2 id="packages" class="mt-3 text-3xl font-semibold text-[#eef2ea]">Dense package index</h2>
                            <p class="mt-2 text-sm text-[#9ca796]">
                                @if ($currentQuery !== '')
                                    Results for "{{ $currentQuery }}"
                                @elseif ($currentCategory !== 'all')
                                    Showing {{ ucfirst($currentCategory) }} packages
                                @elseif ($currentOs !== 'all')
                                    Filtered for {{ strtoupper($currentOs) }}
                                @else
                                    Scan the current utility shelf
                                @endif
                            </p>
                        </div>
                        <div class="text-sm text-[#a9b2a2]">{{ $tools->count() }} packages</div>
                    </div>

                    @if ($tools->isEmpty())
                        <div class="mt-6 rounded-3xl border border-[#2d3728] bg-[#111510] px-6 py-10 text-center text-[#9aa48f]">
                            No tool packages matched the current filters.
                        </div>
                    @else
                        <div class="mt-6 overflow-hidden rounded-[1.5rem] border border-[#2d3728] bg-[#101410]">
                            <div class="hidden grid-cols-[110px_1.5fr_0.95fr_150px] gap-4 border-b border-[#253021] px-5 py-4 font-mono text-[11px] uppercase tracking-[0.26em] text-[#86927d] md:grid">
                                <div>Type</div>
                                <div>Package</div>
                                <div>Platform / integrity</div>
                                <div class="text-right">Updated</div>
                            </div>
                            <div class="divide-y divide-[#242d20]">
                                @foreach ($tools as $tool)
                                    <x-tools.package-row :tool="$tool" :lang="$lang" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <aside id="updated" class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Recently updated</div>
                    <h2 class="mt-3 text-3xl font-semibold text-[#eef2ea]">Update rail</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($recentTools as $tool)
                            <article class="rounded-3xl border border-[#2b3426] bg-[#101410] p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#8b9781]">{{ strtoupper($tool['category']) }}</div>
                                        <a href="{{ route('tools.show', ['slug' => $tool['slug'], 'lang' => $lang]) }}" class="mt-2 block text-xl font-semibold leading-tight text-[#eef2ea] transition hover:text-[#d8ff79]">
                                            {{ $tool['title'] }}
                                        </a>
                                    </div>
                                    <div class="font-mono text-xs uppercase tracking-[0.18em] text-[#7f8a76]">{{ \Illuminate\Support\Carbon::parse($tool['updated_at'])->format('M j') }}</div>
                                </div>
                                <div class="mt-2 text-sm text-[#aab3a3]">{{ $tool['vendor'] }} / v{{ $tool['version'] }}</div>
                                <p class="mt-3 text-sm leading-7 text-[#aab3a3]">{{ $tool['release_notes'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection
