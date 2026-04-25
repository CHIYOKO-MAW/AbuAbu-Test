@extends('layouts.audio')

@section('title', 'My Wishlist | Abu-Abu Audio')
@section('description', 'Your personal wishlist of album downloads.')

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
                <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="text-sm text-white/50 hover:text-white transition">Audio</a>
                <span class="text-white/30">/</span>
                <span class="text-sm text-white">Wishlist</span>
            </div>

            <section class="mb-10">
                <div class="rounded-[30px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_26%),#20252c] p-7 sm:p-8">
                    <div class="flex items-center gap-4">
                        <div class="rounded-full border border-[#ff6b6b]/30 bg-[#ff6b6b]/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#ff8a8a]">
                            ♥
                        </div>
                        <div>
                            <h1 class="font-display text-4xl font-bold text-white sm:text-[3rem]">
                                My Wishlist
                            </h1>
                            <p class="mt-2 text-base text-white/66">
                                {{ count($albums) }} {{ count($albums) === 1 ? 'album' : 'albums' }} saved
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            @if(count($albums) === 0)
                <div class="rounded-[30px] border border-white/6 bg-[#20252c] p-12 text-center">
                    <div class="text-4xl mb-4">♥</div>
                    <h2 class="text-xl font-semibold text-white mb-2">No albums yet</h2>
                    <p class="text-white/50 mb-6">Start adding albums to your wishlist from the catalog.</p>
                    <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="inline-flex rounded-full bg-[#3d9ae9] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#52a8f0]">
                        Browse catalog
                    </a>
                </div>
            @else
                <div class="grid gap-4 sm:gap-5 md:gap-6 grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    @foreach($albums as $album)
                        <x-audio.album-card :album="$album" :lang="$lang" :show-meta-bar="false" />
                    @endforeach
                </div>
            @endif
        </div>
    </main>
@endsection