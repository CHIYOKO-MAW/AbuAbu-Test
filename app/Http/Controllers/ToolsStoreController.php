<?php

namespace App\Http\Controllers;

use App\Support\AbuAbu;
use App\Support\ToolsStore;
use Illuminate\Http\Request;

class ToolsStoreController extends Controller
{
    public function index(Request $request)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = ToolsStore::store();
        $tools = ToolsStore::tools();
        $query = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', 'all'));
        $os = trim((string) $request->query('os', 'all'));
        $tag = trim((string) $request->query('tag', 'all'));
        $sort = trim((string) $request->query('sort', 'featured'));

        return view('tools.index', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'tools' => ToolsStore::filterTools($tools, $query, $category, $os, $tag, $sort),
            'featuredTools' => ToolsStore::featuredTools(),
            'featuredGames' => ToolsStore::featuredGames(),
            'recentTools' => ToolsStore::recentTools(),
            'helpArticles' => ToolsStore::helpArticles(),
            'currentQuery' => $query,
            'currentCategory' => $category,
            'currentOs' => $os,
            'currentTag' => $tag,
            'currentSort' => $sort,
            'pageTitle' => 'Abu-Abu Tools',
            'pageDescription' => $store['hero']['copy'],
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = ToolsStore::store();
        $tool = ToolsStore::findTool($slug);

        abort_unless($tool, 404);

        return view('tools.show', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'tool' => $tool,
            'relatedTools' => ToolsStore::relatedTools($tool),
            'pageTitle' => $tool['title'].' | Abu-Abu Tools',
            'pageDescription' => $tool['summary'],
        ]);
    }

    public function download(Request $request, string $slug)
    {
        AbuAbu::lang($request->query('lang'));
        $tool = ToolsStore::findTool($slug);

        abort_unless($tool, 404);

        return ToolsStore::downloadResponse($tool);
    }

    public function help(Request $request, string $slug)
    {
        $site = config('abuabu.site');
        $lang = AbuAbu::lang($request->query('lang'));
        $store = ToolsStore::store();
        $article = ToolsStore::findHelpArticle($slug);

        abort_unless($article, 404);

        return view('tools.help', [
            'site' => $site,
            'lang' => $lang,
            'store' => $store,
            'article' => $article,
            'helpArticles' => ToolsStore::helpArticles()->reject(fn (array $item) => $item['slug'] === $slug)->take(3)->values(),
            'pageTitle' => $article['title'].' | Abu-Abu Tools',
            'pageDescription' => $article['summary'],
        ]);
    }
}
