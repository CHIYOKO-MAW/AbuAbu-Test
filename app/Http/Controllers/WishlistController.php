<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\AudioStore;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        $store = config('abuabu.store.audio');
        
        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        $albums = [];
        
        if ($wishlist) {
            $items = $wishlist->items()->with('album')->orderBy('position')->get();
            foreach ($items as $item) {
                if ($item->album) {
                    $albums[] = AudioStore::albumFromModel($item->album, $lang);
                }
            }
        }

        return view('wishlist.index', [
            'store' => $store,
            'lang' => $lang,
            'albums' => $albums,
            'wishlist' => $wishlist,
            'pageTitle' => 'My Wishlist | Abu-Abu Audio',
            'pageDescription' => 'Your personal wishlist of audio albums.',
        ]);
    }

    public function apiList(): JsonResponse
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->first();
        
        if (!$wishlist) {
            return response()->json(['items' => []]);
        }

        $items = $wishlist->items()
            ->with('album')
            ->orderBy('position')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->album_id,
                    'title' => $item->album->title,
                    'slug' => $item->album->slug,
                    'artist' => $item->album->artist->name,
                    'position' => $item->position,
                    'added_at' => $item->created_at->toIso8601String(),
                ];
            });

        return response()->json([
            'items' => $items,
            'count' => $items->count(),
        ]);
    }

    public function add(Album $album): JsonResponse
    {
        $wishlist = Wishlist::firstOrCreate(
            ['user_id' => Auth::id()],
            ['name' => 'My Wishlist']
        );

        $wishlist->addAlbum($album);

        return response()->json([
            'success' => true,
            'message' => 'Album added to wishlist',
            'in_wishlist' => true,
        ]);
    }

    public function remove(Album $album): JsonResponse
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->first();

        if (!$wishlist) {
            return response()->json(['success' => false, 'message' => 'Wishlist not found']);
        }

        $removed = $wishlist->removeAlbum($album);

        return response()->json([
            'success' => $removed,
            'message' => $removed ? 'Album removed from wishlist' : 'Album not in wishlist',
            'in_wishlist' => !$removed,
        ]);
    }
}