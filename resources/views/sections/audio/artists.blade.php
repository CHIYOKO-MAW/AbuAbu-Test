@extends('layouts.audio')

@section('title', $pageTitle ?? 'Artists | Abu-Abu Audio')
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

    <main class="bg-[radial-gradient(circle_at_top,rgba(108,92,231,0.06),transparent_18%),linear-gradient(180deg,#2c3138_0%,#32363d_26%,#2d3138_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="text-sm text-white/50 hover:text-white transition">
                    Audio
                </a>
                <span class="text-white/30">/</span>
                <span class="text-sm text-white">Artists</span>
            </div>

            <section class="mb-12">
                <div class="rounded-[30px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_26%),#20252c] p-7 sm:p-8">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[#c8c0ff]">Artist index</div>
                    <h1 class="mt-4 font-display text-4xl font-bold text-white sm:text-[3rem]">
                        Browse by Artist
                    </h1>
                    <p class="mt-4 max-w-2xl text-base text-white/66">
                        Explore all {{ $artists->count() }} artists in the Abu-Abu audio catalog. Click an artist to view their complete discography.
                    </p>
                </div>
            </section>

            <section>
                <div class="grid gap-3 sm:gap-4 grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                    @foreach($artists as $artist)
                        <a href="{{ route('audio.artist', ['slug' => $artist['slug']]) }}" class="group rounded-[24px] border border-white/6 bg-[linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01))] p-6 transition hover:-translate-y-1 hover:border-white/12 hover:bg-[linear-gradient(180deg,rgba(255,255,255,0.04),rgba(255,255,255,0.02))]">
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#6C5CE7]/20 text-xl font-bold text-[#c8b0ff]">
                                    {{ substr($artist['name'], 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-white truncate group-hover:text-[#9bd0ff] transition">
                                        {{ $artist['name'] }}
                                    </h3>
                                    <p class="text-sm text-white/50">
                                        {{ $artist['album_count'] }} {{ $artist['album_count'] === 1 ? 'album' : 'albums' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                @foreach(array_slice($artist['genres'], 0, 3) as $genre)
                                    <span class="rounded-full border border-white/8 px-2.5 py-0.5 text-[10px] uppercase tracking-[0.18em] text-white/45">
                                        {{ $genre }}
                                    </span>
                                @endforeach
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection