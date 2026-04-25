<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Support\AbuAbu;
use App\Support\AudioStore;
use Illuminate\Http\Request;

class AudioStoreController extends Controller
{
    public function index(Request $request)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = AudioStore::store();
        $albums = AudioStore::albums();
        $query = trim((string) $request->query('q', ''));
        $genre = trim((string) $request->query('genre', 'Featured'));
        $type = trim((string) $request->query('type', 'all'));
        $format = trim((string) $request->query('format', 'all'));

        // Extract dynamic genres from albums
        $dynamicGenres = $albums->pluck('genre')->unique()->sortBy(function($g) { return strtolower($g); })->values()->all();
        $store['genre_tabs'] = array_merge(['Featured'], $dynamicGenres);

        return view('audio.index', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'albums' => AudioStore::filterAlbums($albums, $query, $genre, $type, $format),
            'featuredAlbums' => $albums->where('featured', true)->values(),
            'recommendedAlbums' => $albums->where('recommended', true)->values(),
            'currentGenre' => $genre,
            'currentType' => $type,
            'currentFormat' => $format,
            'query' => $query,
            'genres' => $store['genre_tabs'],
            'pageTitle' => 'Abu-Abu Audio',
            'pageDescription' => $store['hero']['copy'],
        ]);
    }

    public function artists(Request $request)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = AudioStore::store();
        $albums = AudioStore::albums();

        $artists = $albums
            ->groupBy('artist_slug')
            ->map(function ($group, $slug) {
                return [
                    'slug' => $slug,
                    'name' => $group->first()['artist'],
                    'album_count' => $group->count(),
                    'genres' => $group->pluck('genre')->unique()->values()->all(),
                ];
            })
            ->values()
            ->sortBy('name');

        return view('audio.artists', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'artists' => $artists,
            'pageTitle' => 'Artists | Abu-Abu Audio',
            'pageDescription' => 'Browse all artists in the Abu-Abu audio catalog',
        ]);
    }

    public function artist(Request $request, string $slug)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = AudioStore::store();
        $albums = AudioStore::albums();

        $artistAlbums = $albums
            ->filter(fn ($album) => $album['artist_slug'] === $slug)
            ->values();

        abort_if($artistAlbums->isEmpty(), 404);

        $artistName = $artistAlbums->first()['artist'];

        return view('audio.artist', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'artist' => $artistName,
            'artistSlug' => $slug,
            'albums' => $artistAlbums,
            'pageTitle' => $artistName . ' | Abu-Abu Audio',
            'pageDescription' => 'Browse albums by ' . $artistName,
        ]);
    }

    public function genre(Request $request, string $slug)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = AudioStore::store();
        $albums = AudioStore::albums();

        $genreAlbums = $albums
            ->filter(fn ($album) => strtolower($album['genre']) === strtolower($slug))
            ->values();

        return view('audio.genre', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'genre' => $slug,
            'albums' => $genreAlbums,
            'pageTitle' => $slug . ' | Abu-Abu Audio',
            'pageDescription' => 'Browse ' . $slug . ' albums in the Abu-Abu catalog',
        ]);
    }

    public function newReleases(Request $request)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = AudioStore::store();
        $albums = AudioStore::albums();

        $newAlbums = $albums
            ->sortByDesc('release_date')
            ->take(20)
            ->values();

        return view('audio.new', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'albums' => $newAlbums,
            'pageTitle' => 'New Releases | Abu-Abu Audio',
            'pageDescription' => 'Browse the latest additions to the Abu-Abu audio catalog',
        ]);
    }

    public function show(Request $request, string $artist, string $album)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = AudioStore::store();
        $selectedAlbum = AudioStore::findAlbum($artist, $album);

        abort_unless($selectedAlbum, 404);

        return view('audio.show', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'album' => $selectedAlbum,
            'relatedAlbums' => AudioStore::relatedAlbums($selectedAlbum),
            'pageTitle' => $selectedAlbum['title'].' | Abu-Abu Audio',
            'pageDescription' => $selectedAlbum['specs']['audio'],
        ]);
    }

    public function download(Request $request, string $artist, string $album)
    {
        AbuAbu::lang($request->query('lang'));

        $selectedAlbum = AudioStore::findAlbum($artist, $album);

        abort_unless($selectedAlbum, 404);

        return AudioStore::downloadResponse($selectedAlbum);
    }
}
