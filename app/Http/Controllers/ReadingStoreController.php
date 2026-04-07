<?php

namespace App\Http\Controllers;

use App\Support\AbuAbu;
use App\Support\ReadingStore;
use Illuminate\Http\Request;

class ReadingStoreController extends Controller
{
    public function index(Request $request)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = ReadingStore::store();
        $items = ReadingStore::items();
        $query = trim((string) $request->query('q', ''));
        $type = trim((string) $request->query('type', 'all'));
        $topic = trim((string) $request->query('topic', 'All topics'));
        $sort = trim((string) $request->query('sort', 'latest'));
        $filteredItems = ReadingStore::filterItems($items, $query, $type, $topic, $sort);

        return view('reading.index', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'items' => $filteredItems,
            'latestItems' => $items->sortByDesc('published_at')->take(4)->values(),
            'updatedItems' => $items->sortByDesc('updated_at')->take(4)->values(),
            'typeCounts' => $items->countBy('type'),
            'currentQuery' => $query,
            'currentType' => $type,
            'currentTopic' => $topic,
            'currentSort' => $sort,
            'pageTitle' => 'Abu-Abu Reading',
            'pageDescription' => $store['hero']['copy'],
        ]);
    }

    public function show(Request $request, string $type, string $slug)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = ReadingStore::store();
        $item = ReadingStore::findItem($type, $slug);

        abort_unless($item, 404);

        return view('reading.show', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'item' => $item,
            'relatedItems' => ReadingStore::relatedItems($item),
            'pageTitle' => $item['title'].' | Abu-Abu Reading',
            'pageDescription' => $item['summary'],
        ]);
    }

    public function download(Request $request, string $type, string $slug)
    {
        AbuAbu::lang($request->query('lang'));
        $item = ReadingStore::findItem($type, $slug);

        abort_unless($item, 404);

        return ReadingStore::downloadResponse($item);
    }
}
