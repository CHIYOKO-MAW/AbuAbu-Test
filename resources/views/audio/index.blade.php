@extends('layouts.audio')

@section('title', $pageTitle ?? 'Abu-Abu Audio')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-audio.store-header
        :store="$store"
        :lang="$lang"
        :genres="$store['genre_tabs']"
        :current-genre="$currentGenre"
        :current-type="$currentType"
        :current-format="$currentFormat"
        :query="$query"
    />

    <main class="bg-[radial-gradient(circle_at_top,rgba(108,92,231,0.06),transparent_18%),linear-gradient(180deg,#2c3138_0%,#32363d_26%,#2d3138_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <section class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-[32px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_26%),#20252c] p-7 shadow-[0_24px_80px_rgba(0,0,0,0.16)] sm:p-8">
                    <div class="inline-flex rounded-full border border-[#6C5CE7]/25 bg-[#6C5CE7]/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#c8c0ff]">
                        {{ $store['hero']['eyebrow'] }}
                    </div>
                    <h1 class="mt-6 max-w-3xl font-display text-4xl font-bold leading-tight text-white sm:text-[3.4rem]">
                        {{ $store['hero']['title'] }}
                    </h1>
                    <p class="mt-5 max-w-2xl text-base leading-8 text-white/66">
                        {{ $store['hero']['copy'] }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#featured" class="rounded-full bg-[#3d9ae9] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#52a8f0]">
                            Explore picks
                        </a>
                        <a href="#catalog" class="rounded-full border border-white/10 bg-white/[0.03] px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/[0.06]">
                            Open catalog
                        </a>
                    </div>

                    <div class="mt-10 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-[24px] border border-white/8 bg-[#171b21] px-5 py-4">
                            <div class="text-[11px] uppercase tracking-[0.28em] text-white/34">Focus</div>
                            <div class="mt-2 text-lg font-semibold text-white">Cover-first browsing</div>
                        </div>
                        <div class="rounded-[24px] border border-white/8 bg-[#171b21] px-5 py-4">
                            <div class="text-[11px] uppercase tracking-[0.28em] text-white/34">Use</div>
                            <div class="mt-2 text-lg font-semibold text-white">Search by artist or album</div>
                        </div>
                        <div class="rounded-[24px] border border-white/8 bg-[#171b21] px-5 py-4">
                            <div class="text-[11px] uppercase tracking-[0.28em] text-white/34">Format</div>
                            <div class="mt-2 text-lg font-semibold text-white">Lossless-ready shelf</div>
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($featuredAlbums->take(2) as $featured)
                        <div class="{{ $loop->first ? 'sm:col-span-2' : '' }}">
                            <x-audio.album-card :album="$featured" :lang="$lang" />
                        </div>
                    @endforeach
                    <div class="rounded-[28px] border border-white/6 bg-[#20252c] p-6 sm:col-span-2">
                        <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#f0d692]/72">Curator note</div>
                        <p class="mt-4 text-sm leading-7 text-white/60">
                            This page is intentionally clearer and calmer than the reference you shared. It still feels like an audio storefront, but the visual rhythm is more boutique and more in line with Abu-Abu.
                        </p>
                    </div>
                </div>
            </section>

            <section id="featured" class="mt-12">
                <div class="flex flex-col gap-4 rounded-[30px] border border-white/6 bg-[#21262d] px-6 py-5 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[#f0d692]/68">Entry points</div>
                        <h2 class="mt-3 font-display text-2xl font-bold text-white">Recommended albums to start with</h2>
                        <p class="mt-2 text-sm text-white/54">A guided first row instead of a flat storefront strip.</p>
                    </div>
                    <a href="#catalog" class="inline-flex rounded-full border border-[#3d9ae9]/25 bg-[#3d9ae9]/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#91ceff] transition hover:bg-[#3d9ae9]/16">
                        {{ $store['promo']['link_label'] }}
                    </a>
                </div>

                <div class="mt-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
                    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($featuredAlbums->take(3) as $featured)
                            <x-audio.album-card :album="$featured" :lang="$lang" />
                        @endforeach
                    </div>
                    <div class="rounded-[30px] border border-white/6 bg-[linear-gradient(180deg,#1f232a_0%,#181c22_100%)] p-6">
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-white/34">Why these picks</div>
                        <div class="mt-5 space-y-4">
                            @foreach ($featuredAlbums->take(3) as $featured)
                                <div class="rounded-[22px] border border-white/6 bg-white/[0.02] px-4 py-4">
                                    <div class="text-sm font-semibold text-white">{{ $featured['title'] }}</div>
                                    <div class="mt-1 text-xs uppercase tracking-[0.24em] text-white/34">{{ $featured['artist'] }} / {{ $featured['genre'] }}</div>
                                    <p class="mt-3 text-sm leading-7 text-white/54">{{ $featured['specs']['note'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="mt-14">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-white/34">Shelf highlight</div>
                        <h2 class="mt-3 font-display text-2xl font-bold text-white">Recommended releases</h2>
                    </div>
                    <div class="rounded-full border border-white/8 bg-[#1f2329] px-4 py-2 text-xs uppercase tracking-[0.24em] text-white/46">
                        compact recommendation row
                    </div>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-5">
                    @foreach ($recommendedAlbums->take(5) as $recommended)
                        <x-audio.album-card :album="$recommended" :lang="$lang" :show-meta-bar="false" />
                    @endforeach
                </div>
            </section>

            <section id="catalog" class="mt-16">
                <div class="flex flex-wrap items-end justify-between gap-4 border-b border-white/8 pb-5">
                    <div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-white/34">Full catalog</div>
                        <h2 class="mt-3 font-display text-2xl font-bold text-white">Audio catalog</h2>
                        <p class="mt-2 text-sm text-white/55">
                            @if ($query !== '')
                                Results for "{{ $query }}"
                            @elseif ($currentGenre !== 'Featured')
                                Showing {{ $currentGenre }} releases
                            @else
                                Browse the current storefront selection
                            @endif
                        </p>
                    </div>
                    <div class="rounded-full border border-white/10 bg-[#1f2329] px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-white/55">
                        {{ $albums->count() }} releases
                    </div>
                </div>

                @if ($albums->isEmpty())
                    <div class="mt-8 rounded-[28px] border border-white/8 bg-[#20252c] px-6 py-10 text-center text-white/55">
                        No albums match the current filters.
                    </div>
                @else
                    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                        @foreach ($albums as $album)
                            <x-audio.album-card :album="$album" :lang="$lang" />
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection
