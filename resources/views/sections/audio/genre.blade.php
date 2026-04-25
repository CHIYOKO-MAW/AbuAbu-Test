@extends('layouts.audio')

@section('title', $pageTitle ?? $genre . ' | Abu-Abu Audio')
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
                <span class="text-sm text-white">{{ $genre }}</span>
            </div>

            <section class="mb-10">
                <div class="rounded-[30px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_26%),#20252c] p-7 sm:p-8">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[#FDCB6E]/80">Genre</div>
                    <h1 class="mt-4 font-display text-4xl font-bold text-white sm:text-[3rem]">
                        {{ $genre }}
                    </h1>
                    <p class="mt-4 max-w-2xl text-base text-white/66">
                        {{ $albums->count() }} {{ $albums->count() === 1 ? 'release' : 'releases' }} in this genre
                    </p>
                </div>
            </section>

            <section>
                @if($albums->isEmpty())
                    <x-ui.empty-state
                        class="mt-8"
                        title="No albums in this genre"
                        copy="Check back later for new additions."
                    />
                @else
                    <div class="grid gap-4 sm:gap-5 md:gap-6 grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                        @foreach($albums as $album)
                            <x-audio.album-card :album="$album" :lang="$lang" />
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection