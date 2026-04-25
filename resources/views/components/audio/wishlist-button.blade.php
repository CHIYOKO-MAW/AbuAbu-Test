@props([
    'album',
    'lang' => 'en',
])

@php
    $inWishlist = Auth::check() && isset($inWishlist) ? $inWishlist : false;
    $route = route('audio.show', ['artist' => $album['artist_slug'], 'album' => $album['slug'], 'lang' => $lang]);
@endphp

@auth
    <button 
        type="button"
        x-data="wishlistBtn({{ $album['id'] }}, {{ Auth::id() }})"
        x-init="check()"
        @click="toggle()"
        :class="inWishlist ? 'border-[#ff6b6b]/30 bg-[#ff6b6b]/10 text-[#ff8a8a]' : 'border-white/10 bg-white/[0.03] text-white'"
        class="rounded-2xl border px-5 py-2.5 text-sm font-semibold transition hover:bg-white/[0.06] flex items-center gap-2"
    >
        <span x-text="inWishlist ? '♥' : '♡'"></span>
        <span x-text="inWishlist ? 'In Wishlist' : 'Add to Wishlist'"></span>
    </button>

    <script>
    function wishlistBtn(albumId, userId) {
        return {
            albumId: albumId,
            inWishlist: false,
            async check() {
                try {
                    const res = await fetch(`/api/wishlist`);
                    const data = await res.json();
                    this.inWishlist = data.items ? data.items.some(i => i.id === this.albumId) : false;
                } catch (e) {
                    this.inWishlist = false;
                }
            },
            async toggle() {
                const method = this.inWishlist ? 'DELETE' : 'POST';
                try {
                    await fetch(`/api/wishlist/${this.albumId}`, { method });
                    this.inWishlist = !this.inWishlist;
                } catch (e) {
                    console.error(e);
                }
            }
        };
    }
    </script>
@else
    <a 
        href="{{ route('auth.login') }}?redirect={{ urlencode($route) }}"
        class="rounded-2xl border border-white/10 bg-white/[0.03] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/[0.06] flex items-center gap-2"
    >
        <span>♡</span>
        <span>Add to Wishlist</span>
    </a>
@endauth