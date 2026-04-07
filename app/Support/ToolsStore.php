<?php

namespace App\Support;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ToolsStore
{
    public static function store(): array
    {
        return config('tools', []);
    }

    public static function tools(): Collection
    {
        return collect(self::store()['tools'] ?? [])
            ->map(fn (array $tool) => self::hydrateTool($tool))
            ->values();
    }

    public static function helpArticles(): Collection
    {
        $tools = self::tools()->keyBy('slug');

        return collect(self::store()['help_articles'] ?? [])
            ->map(function (array $article) use ($tools) {
                $article['related_tools'] = collect($article['related_tools'] ?? [])
                    ->map(fn (string $slug) => $tools->get($slug))
                    ->filter()
                    ->values();

                return $article;
            })
            ->values();
    }

    public static function filterTools(Collection $tools, string $query = '', string $category = 'all', string $os = 'all', string $tag = 'all', string $sort = 'featured'): Collection
    {
        $query = strtolower(trim($query));

        $filtered = $tools->filter(function (array $tool) use ($query, $category, $os, $tag) {
            $haystack = strtolower(implode(' ', [
                $tool['title'],
                $tool['vendor'],
                $tool['summary'],
                implode(' ', $tool['tags']),
                implode(' ', $tool['os']),
            ]));

            $matchesQuery = $query === '' || str_contains($haystack, $query);
            $matchesCategory = $category === 'all' || $tool['category'] === $category;
            $matchesOs = $os === 'all' || in_array($os, $tool['os'], true);
            $matchesTag = $tag === 'all' || in_array($tag, $tool['tags'], true);

            return $matchesQuery && $matchesCategory && $matchesOs && $matchesTag;
        });

        return match ($sort) {
            'updated' => $filtered->sortByDesc('updated_at')->values(),
            'title' => $filtered->sortBy('title')->values(),
            default => $filtered->sortByDesc(fn (array $tool) => [$tool['featured'], $tool['updated_at']])->values(),
        };
    }

    public static function findTool(string $slug): ?array
    {
        return self::tools()->first(fn (array $tool) => $tool['slug'] === $slug);
    }

    public static function relatedTools(array $selectedTool, int $limit = 4): Collection
    {
        return self::tools()
            ->reject(fn (array $tool) => $tool['slug'] === $selectedTool['slug'])
            ->filter(fn (array $tool) => $tool['category'] === $selectedTool['category'] || count(array_intersect($tool['tags'], $selectedTool['tags'])) > 0)
            ->take($limit)
            ->values();
    }

    public static function featuredTools(): Collection
    {
        return self::tools()->where('featured', true)->take(4)->values();
    }

    public static function recentTools(): Collection
    {
        return self::tools()->sortByDesc('updated_at')->take(5)->values();
    }

    public static function featuredGames(): Collection
    {
        return self::tools()
            ->where('category', 'games')
            ->where('featured', true)
            ->take(3)
            ->values();
    }

    public static function findHelpArticle(string $slug): ?array
    {
        return self::helpArticles()->first(fn (array $article) => $article['slug'] === $slug);
    }

    /**
     * @throws FileNotFoundException
     */
    public static function downloadResponse(array $tool): StreamedResponse
    {
        abort_unless($tool['download']['available'] ?? false, Response::HTTP_NOT_FOUND);

        return Storage::disk($tool['download']['disk'])->download(
            $tool['download']['path'],
            $tool['download']['filename'],
        );
    }

    public static function hydrateTool(array $tool): array
    {
        $tool = array_merge([
            'release_status' => 'Stable utility',
            'license_state' => 'Requires official license',
            'build_type' => 'Installer archive',
            'archive_notes' => [],
            'screenshots' => [],
            'requirements' => [
                'minimum' => [],
                'recommended' => [],
            ],
        ], $tool);

        $download = array_merge([
            'enabled' => false,
            'disk' => 'local',
            'path' => null,
            'filename' => $tool['slug'].'.zip',
            'label' => 'Download package',
            'size' => null,
        ], $tool['download'] ?? []);

        $download['available'] = false;

        if ($download['enabled'] && is_string($download['path']) && $download['path'] !== '') {
            $download['available'] = Storage::disk($download['disk'])->exists($download['path']);

            if ($download['available'] && $download['size'] === null) {
                $download['size'] = self::formatBytes(Storage::disk($download['disk'])->size($download['path']));
            }
        }

        $tool['download'] = $download;

        return $tool;
    }

    protected static function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = max($bytes, 0);
        $power = $size > 0 ? (int) floor(log($size, 1024)) : 0;
        $power = min($power, count($units) - 1);
        $value = $size / (1024 ** $power);

        return number_format($value, $power === 0 ? 0 : 1).' '.$units[$power];
    }
}
