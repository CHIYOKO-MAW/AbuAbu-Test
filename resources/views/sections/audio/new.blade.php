@extends('layouts.audio')

@section('title', $pageTitle ?? 'New Releases | Abu-Abu Audio')
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
                <span class="text-sm text-white">New Releases</span>
            </div>

            <section class="mb-10">
                <div class="rounded-[30px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.12),transparent_26%),#20252c] p-7 sm:p-8">
                    <div class="flex items-center gap-4">
                        <div class="rounded-full border border-[#00B894]/30 bg-[#00B894]/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#6de4b8]">
                            NEW
                        </div>
                        <div>
                            <h1 class="font-display text-4xl font-bold text-white sm:text-[3rem]">
                                New Releases
                            </h1>
                            <p class="mt-2 text-base text-white/66">
                                The latest additions to the Abu-Abu audio catalog
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                @if($albums->isEmpty())
                    <x-ui.empty-state
                        class="mt-8"
                        title="No new releases"
                        copy="Check back later for updates."
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