<?php

namespace App\Http\Controllers;

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
            'pageTitle' => 'Abu-Abu Audio',
            'pageDescription' => $store['hero']['copy'],
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
