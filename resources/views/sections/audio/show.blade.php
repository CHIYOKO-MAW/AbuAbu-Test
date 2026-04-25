@extends('layouts.audio')

@section('title', $pageTitle ?? 'Abu-Abu Audio')
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

    <main class="bg-[radial-gradient(circle_at_top,rgba(61,154,233,0.05),transparent_15%),linear-gradient(180deg,#2c3138_0%,#31363d_100%)] animate-[shift_60s_linear_infinite]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="inline-flex items-center gap-2 rounded-full border border-white/8 bg-white/[0.02] px-4 py-2 text-sm text-white/58 transition hover:text-white">
                <span>&larr;</span>
                <span>Back to audio catalog</span>
            </a>

            <div class="flex flex-col md:flex-row mt-6">
                <aside class="w-[260px] md:w-[320px] shrink-0">
                    <div class="rounded-[32px] border border-white/6 bg-[linear-gradient(180deg,#1d2229_0%,#181c22_100%)] p-5">
                        <x-audio.cover :album="$album" size="hero" />

                        <div class="mt-5 rounded-[24px] border border-white/6 bg-[#13181e] p-4">
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Release facts</div>
                            <div class="mt-4 space-y-3 text-sm text-white/60">
                                <div class="flex items-center justify-between gap-4">
                                    <span>Released</span>
                                    <span class="text-white">{{ \Illuminate\Support\Carbon::parse($album['release_date'])->format('F j, Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <span>Originated</span>
                                    <span class="text-white">{{ \Illuminate\Support\Carbon::parse($album['originated'])->format('F j, Y') }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <span>Duration</span>
                                    <span class="text-white">{{ $album['duration'] }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <span>Label</span>
                                    <span class="text-right text-white">{{ $album['label'] }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <span>Genre</span>
                                    <span class="text-white">{{ $album['genre'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <section class="flex-1">

                <section>
                    <div class="rounded-[32px] border border-white/6 bg-[radial-gradient(circle_at_top_left,rgba(108,92,231,0.10),transparent_24%),#20252c] p-7 shadow-[0_22px_80px_rgba(0,0,0,0.14)] sm:p-8">
                        <div class="flex flex-wrap items-center gap-3 text-[11px] font-semibold uppercase tracking-[0.28em]">
                            <span class="rounded-full border border-[#6C5CE7]/30 bg-[#6C5CE7]/12 px-3 py-1 text-[#d0c7ff]">{{ strtoupper($album['type']) }}</span>
                            <span class="rounded-full border border-white/8 px-3 py-1 text-white/42">{{ implode(' / ', $album['formats']) }}</span>
                        </div>

                        <div class="mt-6 grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                            <div>
                                <h1 class="font-display text-4xl font-bold tracking-tight text-white sm:text-[3.5rem] title-float">{{ $album['title'] }}</h1>
                                <div class="mt-3 text-2xl font-light italic text-white/82 artist-float">{{ $album['artist'] }}</div>
                                <p class="mt-8 max-w-3xl text-lg leading-8 text-white/80">{{ $album['specs']['audio'] }}</p>
                                <p class="mt-8 max-w-3xl text-base leading-8 text-white/58">{{ $album['editor_notes'] }}</p>

                                <div class="mt-8 flex flex-wrap gap-3">
                                    @if ($album['download']['available'])
                                        <a
                                            href="{{ route('audio.download', ['artist' => $album['artist_slug'], 'album' => $album['slug']]) }}"
                                            class="rounded-2xl bg-[#eef1f6] px-6 py-3 text-base font-semibold text-[#313744] transition hover:bg-white"
                                        >
                                            {{ $album['download']['label'] }} ↓
                                        </a>
                                    @else
                                        <span class="rounded-2xl border border-white/10 bg-white/[0.03] px-6 py-3 text-base font-semibold text-white/42">
                                            Not available yet
                                        </span>
                                    @endif

                                     <button 
                                         type="button"
                                         onclick="alert('Wishlist: {{ $album['title'] }} - Login to save to wishlist')"
                                         class="rounded-2xl border border-white/10 bg-white/[0.03] px-6 py-3 text-base font-semibold text-white wishlist-btn transition hover:bg-white/[0.06]"
                                     >
                                         ♡ Keep This One
                                     </button>
                                </div>
                            </div>

                            <div class="grid gap-4">
                                <div class="rounded-[24px] border border-white/6 bg-[#171b21] p-5">
                                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Available download</div>
                                    <div class="mt-4 space-y-3 text-sm text-white/58">
                                        <div class="flex items-center justify-between gap-4">
                                            <span>Release format</span>
                                            <span class="text-right text-white">{{ implode(' / ', $album['formats']) }}</span>
                                        </div>
                                        <div class="flex items-center justify-between gap-4">
                                            <span>Archive size</span>
                                            <span class="text-white">{{ $album['download']['size'] ?? 'Waiting for upload' }}</span>
                                        </div>
                                        <div class="flex items-center justify-between gap-4">
                                            <span>Status</span>
                                            <span class="{{ $album['download']['available'] ? 'text-[#8fe4d2]' : 'text-white/42' }}">
                                                {{ $album['download']['available'] ? 'Ready to download' : 'Not available yet' }}
                                            </span>
                                        </div>
                                    </div>

                                    @if ($album['download']['available'])
                                        <a
                                            href="{{ route('audio.download', ['artist' => $album['artist_slug'], 'album' => $album['slug'], 'lang' => $lang]) }}"
                                            class="mt-5 inline-flex rounded-2xl border border-[#3d9ae9]/25 bg-[#3d9ae9]/10 px-5 py-3 text-sm font-semibold text-[#9fd4ff] transition hover:bg-[#3d9ae9]/16"
                                        >
                                            Download full album archive
                                        </a>
                                    @endif
                                </div>

                                <div class="rounded-[24px] border border-white/6 bg-[#171b21] p-5">
                                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Listening profile</div>
                                    <div class="mt-4 text-lg font-semibold text-white">{{ $album['genre'] }} / {{ strtoupper($album['type']) }}</div>
                                    <p class="mt-3 text-sm leading-7 text-white/56">{{ $album['specs']['note'] }}</p>
                                </div>
                                <div class="rounded-[24px] border border-white/6 bg-[#171b21] p-5">
                                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Quick jump</div>
                                    <div class="mt-4 flex flex-wrap gap-2.5">
                                        @foreach ($store['detail_tabs'] as $index => $tab)
                                            <a href="{{ $index === 0 ? '#tracks' : ($index === 1 ? '#notes' : ($index === 2 ? '#technical' : '#related')) }}" class="rounded-full border border-white/8 px-4 py-2 text-sm text-white/62 transition hover:text-white">
                                                {{ $tab }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section id="tracks" class="mt-8">
                        <div class="flex flex-wrap items-end justify-between gap-4">
                            <div>
                                <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Tracklist</div>
                                <h2 class="mt-3 font-display text-2xl font-bold text-white">Album tracks</h2>
                                <p class="mt-2 text-sm text-white/50">Track row stays in preview mode. Full download is handled from the album download action above.</p>
                            </div>
                            <div class="rounded-full border border-white/8 bg-[#1f2329] px-4 py-2 text-xs uppercase tracking-[0.24em] text-white/46">
                                {{ count($album['tracks']) }} tracks
                            </div>
                        </div>

                        <div class="mt-6 overflow-hidden rounded-[30px] border border-white/6 bg-[#20252c]">
                            @foreach ($album['tracks'] as $track)
                                <div class="grid gap-4 border-b border-white/6 px-5 py-5 last:border-b-0 md:grid-cols-[88px_56px_1fr_88px] md:items-center">
                                    <div class="text-2xl font-light text-white/86">{{ $track['number'] }}</div>
                                    @if(!empty($track['preview']))
                                    <a href="{{ $track['preview'] }}" target="_blank" class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/[0.04] text-xs text-[#7dbfff] hover:bg-white/[0.08] transition">
                                        ▶
                                    </a>
                                    @else
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/[0.04] text-xs text-white/20">
                                        ▶
                                    </div>
                                    @endif
                                    <div>
                                        <div class="text-[1.04rem] text-white">{{ $track['title'] }}</div>
                                        <div class="mt-1 text-sm text-white/50">{{ $track['artist'] }}</div>
                                    </div>
                                    <div class="text-right text-xl font-light text-white/86">{{ $track['duration'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <div class="mt-8 grid gap-6 xl:grid-cols-2">
                        <section id="notes" class="rounded-[30px] border border-white/6 bg-[#20252c] p-6">
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Notes</div>
                            <h2 class="mt-3 font-display text-2xl font-bold text-white">Editor's Notes</h2>
                            <p class="mt-4 text-sm leading-8 text-white/62">{{ $album['editor_notes'] }}</p>
                        </section>

                        <section id="technical" class="rounded-[30px] border border-white/6 bg-[#20252c] p-6">
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-white/34">Audio data</div>
                            <h2 class="mt-3 font-display text-2xl font-bold text-white">Technical Notes</h2>
                            <div class="mt-4 grid gap-3 text-sm text-white/62">
                                <div class="rounded-2xl border border-white/6 bg-[#171b21] px-4 py-3">
                                    Format <span class="ml-3 text-white">{{ implode(', ', $album['formats']) }}</span>
                                </div>
                                <div class="rounded-2xl border border-white/6 bg-[#171b21] px-4 py-3">
                                    Sample Rate <span class="ml-3 text-white">{{ $album['specs']['sample_rate'] }}</span>
                                </div>
                                <div class="rounded-2xl border border-white/6 bg-[#171b21] px-4 py-3">
                                    Bit Depth <span class="ml-3 text-white">{{ $album['specs']['bit_depth'] }}</span>
                                </div>
                                <div class="rounded-2xl border border-white/6 bg-[#171b21] px-4 py-3">
                                    Catalog Note <span class="ml-3 text-white">{{ $album['specs']['note'] }}</span>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>

            <section id="related" class="mt-16">
                <div class="flex flex-wrap items-end justify-between gap-4">
                    <div>
                        <div class="text-[11px] font-semibold uppercase tracking-[0.32em] text-[#f0d692]/68">Continue browsing</div>
                        <h2 class="mt-3 font-display text-2xl font-bold text-white">Related albums</h2>
                    </div>
                    <a href="{{ route('audio.index', ['lang' => $lang]) }}" class="rounded-full border border-[#3d9ae9]/25 bg-[#3d9ae9]/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-[#91ceff] transition hover:bg-[#3d9ae9]/16">
                        Back to storefront
                    </a>
                </div>

                <div class="mt-8 grid gap-4 sm:gap-5 md:gap-6 grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    @foreach ($relatedAlbums as $related)
                        <x-audio.album-card :album="$related" :lang="$lang" />
                    @endforeach
                </div>
</section>
        </section>
            </div>
          </div>
        </div>
      </main>
<style>
  @keyframes shift {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
  }
  @keyframes float-title {
    0%, 100% { transform: translateX(0px) rotate(0deg); }
    50% { transform: translateX(-1px) rotate(0.15deg); }
  }
  @keyframes float-artist {
    0%, 100% { transform: translateX(0px) rotate(0deg); }
    50% { transform: translateX(1px) rotate(-0.15deg); }
  }
  .title-float {
    animation: float-title 6s ease-in-out infinite;
  }
  .artist-float {
    animation: float-artist 6s ease-in-out infinite;
  }
  .wishlist-btn {
    transition: transform 0.3s ease, background-color 0.3s ease;
  }
  .wishlist-btn:hover {
    transform: rotate(-1.5deg) scale(1.015);
    background-color: rgba(255,255,255,0.06);
  }
</style>
@endsection
