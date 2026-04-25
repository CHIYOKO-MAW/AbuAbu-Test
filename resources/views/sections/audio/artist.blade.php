@extends('layouts.audio')

@section('title', $pageTitle ?? $artist . ' | Abu-Abu Audio')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-audio.store-header
        :store="$store"
        :lang="$lang"
        :genres="$store['genre_tabs']"
        current-genre="Featured"
        current-type="all"
        current-format="all"
        query=""
    />

    <main class="bg-[radial-gradient(circle_at_top,rgba(108,92,231,0.06),transparent_18%),linear-gradient(180deg,#2c3138_0%,#32363d_26%,#2d3138_100%)] animate-[shift_120s_linear_infinite]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="text-sm text-white/50 hover:text-white transition">
                    Audio
                </a>
                <span class="text-white/30">/</span>
                <a href="{{ route('audio.artists', ['lang' => $lang]) }}" class="text-sm text-white/50 hover:text-white transition">
                    Artists
                </a>
                <span class="text-white/30">/</span>
                <span class="text-sm text-white">{{ $artist }}</span>
            </div>

            <section class="mb-10">
                <div class="rounded-[30px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_26%),#20252c] p-7 sm:p-8">
                    <div class="flex items-center gap-6">
                        <div class="flex h-24 w-24 items-center justify-center rounded-full bg-[#6C5CE7]/20 text-4xl font-bold text-[#c8b0ff]">
                            {{ substr($artist, 0, 1) }}
                        </div>
                        <div>
                            <h1 class="font-display text-4xl font-bold text-white sm:text-[3rem]">
                                {{ $artist }}
                            </h1>
                            <p class="mt-2 text-base text-white/66">
                                {{ $albums->count() }} {{ $albums->count() === 1 ? 'release' : 'releases' }} available
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="flex flex-wrap items-end justify-between gap-4 border-b border-white/8 pb-5 mb-8">
                    <div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-white/34">Discography</div>
                        <h2 class="mt-3 font-display text-2xl font-bold text-white">All releases</h2>
                    </div>
                </div>

                <div class="grid gap-4 sm:gap-5 md:gap-6 grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    @foreach($albums as $album)
                        <x-audio.album-card :album="$album" :lang="$lang" />
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection