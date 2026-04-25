@props([
    'albums' => [],
    'lang' => 'en',
])

@php
$carouselAlbums = collect($albums)->filter(fn($a) => data_get($a, 'cover.image'))->values();
$count = $carouselAlbums->count();
@endphp

@if($count > 0)
<style>
@keyframes carouselSlide {
    0%, 40% { opacity: 1; z-index: 10; }
    41.67%, 100% { opacity: 0; z-index: 0; }
}
.carousel-item { animation: carouselSlide {{ $count * 5 }}s infinite; }
@for($i = 0; $i < $count; $i++)
.carousel-item-{{ $i }} { animation-delay: {{ $i * 5 }}s; }
@endfor
</style>

<div class="relative overflow-hidden rounded-[32px] aspect-[16/9] sm:aspect-[21/9] lg:aspect-[24/9]">
    @foreach($carouselAlbums as $i => $album)
    <a href="{{ route('audio.show', ['artist' => $album['artist_slug'], 'album' => $album['slug'], 'lang' => $lang]) }}" 
       class="carousel-item carousel-item-{{ $i }} absolute inset-0 group transition-opacity duration-700">
        <div class="absolute inset-0" style="background: linear-gradient(145deg, {{ data_get($album, 'cover.palette.0', '#1a1a2e') }} 0%, {{ data_get($album, 'cover.palette.1', '#16213e') }} 40%, {{ data_get($album, 'cover.palette.2', '#0f3460') }} 100%)"></div>
        @if(data_get($album, 'cover.image'))
        <img src="{{ asset(data_get($album, 'cover.image')) }}" alt="{{ data_get($album, 'cover.alt') }}" class="absolute inset-0 w-full h-full object-cover"/>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 p-6 sm:p-8 lg:p-10 pointer-events-none">
            <span class="rounded-full bg-[#6C5CE7]/40 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white mb-3 inline-block">Featured</span>
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2">{{ $album['title'] }}</h3>
            <p class="text-white/70 text-sm sm:text-base">{{ $album['artist'] }} / {{ data_get($album, 'genre') }}</p>
        </div>
    </a>
    @endforeach
    
    @if($count > 1)
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-30 flex gap-2">
        @for($i = 0; $i < $count; $i++)
        <span class="w-2 h-2 rounded-full bg-white/40"></span>
        @endfor
    </div>
    @endif
</div>
@else
<div class="rounded-[32px] aspect-[16/9] sm:aspect-[21/9] lg:aspect-[24/9] bg-white/5 flex items-center justify-center">
    <span class="text-white/40 text-sm">No featured albums</span>
</div>
@endif