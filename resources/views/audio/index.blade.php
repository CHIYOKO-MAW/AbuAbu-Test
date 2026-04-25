@extends('layouts.audio')

@section('title', $pageTitle ?? 'Abu-Abu Audio')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    @if($query !== '' || $currentGenre !== 'Featured' || $currentType !== 'all' || $currentFormat !== 'all')
    <script>document.addEventListener('DOMContentLoaded', function() { document.getElementById('catalog')?.scrollIntoView({ behavior: 'smooth' })});</script>
    @endif
    <x-audio.store-header
        :store="$store"
        :lang="$lang"
        :genres="$genres"
        :current-genre="$currentGenre"
        :current-type="$currentType"
        :current-format="$currentFormat"
        :query="$query"
    />

    <main class="bg-[radial-gradient(circle_at_top,rgba(108,92,231,0.06),transparent_18%),linear-gradient(180deg,#2c3138_0%,#32363d_26%,#2d3138_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <section class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-[32px] overflow-hidden border border-white/6 shadow-[0_24px_80px_rgba(0,0,0,0.16)]">
                    <x-audio.featured-carousel :albums="$featuredAlbums" :lang="$lang" />
                    <div class="bg-[#20252c] p-6 sm:p-8">
                        <h1 class="font-display text-3xl sm:text-4xl font-bold leading-tight text-white">
                            {{ $store['hero']['title'] }}
                        </h1>
                        <p class="mt-3 text-base leading-7 text-white/60">
                            {{ $store['hero']['copy'] }}
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="#catalog" class="rounded-full bg-[#3d9ae9] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#52a8f0]">
                                Browse catalog
                            </a>
                            <a href="{{ route('audio.new') }}" class="rounded-full border border-white/10 bg-white/[0.03] px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/[0.06]">
                                New releases
                            </a>
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
                    <div class="flex items-center gap-3">
                        @if ($query !== '' || $currentGenre !== 'Featured' || $currentType !== 'all' || $currentFormat !== 'all')
                            <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="rounded-full border border-[#ff6b6b]/30 bg-[#ff6b6b]/10 px-3 py-1.5 text-xs font-semibold text-[#ff8a8a] transition hover:bg-[#ff6b6b]/20">
                                Clear filters
                            </a>
                        @endif
                        <div class="rounded-full border border-white/10 bg-[#1f2329] px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-white/55">
                            {{ $albums->count() }} releases
                        </div>
                    </div>
                </div>

                @if ($query !== '' || $currentGenre !== 'Featured' || $currentType !== 'all' || $currentFormat !== 'all')
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="text-[11px] uppercase tracking-[0.2em] text-white/38">Active filters:</span>
                        @if ($query !== '')
                            <span class="rounded-full border border-[#3d9ae9]/30 bg-[#3d9ae9]/10 px-3 py-1 text-xs text-[#7bc4ff]">
                                Search: "{{ $query }}"
                            </span>
                        @endif
                        @if ($currentGenre !== 'Featured')
                            <span class="rounded-full border border-[#FDCB6E]/30 bg-[#FDCB6E]/10 px-3 py-1 text-xs text-[#f5d885]">
                                Genre: {{ $currentGenre }}
                            </span>
                        @endif
                        @if ($currentType !== 'all')
                            <span class="rounded-full border border-[#6C5CE7]/30 bg-[#6C5CE7]/10 px-3 py-1 text-xs text-[#c4b8ff]">
                                Type: {{ ucfirst($currentType) }}
                            </span>
                        @endif
                        @if ($currentFormat !== 'all')
                            <span class="rounded-full border border-[#00B894]/30 bg-[#00B894]/10 px-3 py-1 text-xs text-[#6de4b8]">
                                Format: {{ $currentFormat }}
                            </span>
                        @endif
                    </div>
                @endif

                @if ($albums->isEmpty())
                    <x-ui.empty-state
                        class="mt-8"
                        title="No albums matched"
                        copy="Try another artist, genre, release type, or file format."
                    />
                @else
                    <div class="mt-8 grid gap-4 sm:gap-5 md:gap-6 grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                        @foreach ($albums as $album)
                            <x-audio.album-card :album="$album" :lang="$lang" :show-meta-bar="false" />
                        @endforeach
                    </div>
                @endif
            </section>

            @if(!$recommendedAlbums->isEmpty())
            <section class="mt-14">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-white/34">Keep listening</div>
                        <h2 class="mt-3 font-display text-2xl font-bold text-white">Recommended for you</h2>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 sm:gap-5 md:gap-6 grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    @foreach($recommendedAlbums->take(5) as $rec)
                        <x-audio.album-card :album="$rec" :lang="$lang" :show-meta-bar="false" />
                    @endforeach
                </div>
            </section>
            @endif
        </div>
    </main>
@endsection
