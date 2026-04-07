<?php

namespace App\Support;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReadingStore
{
    public static function store(): array
    {
        return config('reading', []);
    }

    public static function items(): Collection
    {
        return collect(self::store()['items'] ?? [])
            ->map(fn (array $item) => self::hydrateItem($item))
            ->values();
    }

    public static function filterItems(Collection $items, string $query = '', string $type = 'all', string $topic = 'All topics', string $sort = 'latest'): Collection
    {
        $query = strtolower(trim($query));

        $filtered = $items->filter(function (array $item) use ($query, $type, $topic) {
            $matchesQuery = $query === ''
                || str_contains(strtolower(implode(' ', [$item['title'], $item['author'], $item['topic'], $item['summary']])), $query);
            $matchesType = $type === 'all' || $item['type'] === $type;
            $matchesTopic = $topic === 'All topics' || $item['topic'] === $topic;

            return $matchesQuery && $matchesType && $matchesTopic;
        });

        return match ($sort) {
            'updated' => $filtered->sortByDesc('updated_at')->values(),
            'title' => $filtered->sortBy('title')->values(),
            default => $filtered->sortByDesc('published_at')->values(),
        };
    }

    public static function findItem(string $type, string $slug): ?array
    {
        return self::items()->first(function (array $item) use ($type, $slug) {
            return $item['type'] === $type && $item['slug'] === $slug;
        });
    }

    public static function relatedItems(array $selectedItem, int $limit = 4): Collection
    {
        return self::items()
            ->reject(fn (array $item) => $item['type'] === $selectedItem['type'] && $item['slug'] === $selectedItem['slug'])
            ->filter(fn (array $item) => $item['topic'] === $selectedItem['topic'] || $item['type'] === $selectedItem['type'])
            ->sortByDesc('updated_at')
            ->take($limit)
            ->values();
    }

    /**
     * @throws FileNotFoundException
     */
    public static function downloadResponse(array $item): StreamedResponse
    {
        abort_unless($item['download']['available'] ?? false, Response::HTTP_NOT_FOUND);

        return Storage::disk($item['download']['disk'])->download(
            $item['download']['path'],
            $item['download']['filename'],
        );
    }

    public static function hydrateItem(array $item): array
    {
        $coverImage = data_get($item, 'cover.image');
        $coverAvailable = is_string($coverImage) && $coverImage !== '' && is_file(public_path($coverImage));

        $item['cover'] = array_merge([
            'image' => null,
            'alt' => $item['title'].' cover',
            'palette' => ['#f6efe4', '#c8b69e', '#41372c'],
        ], $item['cover'] ?? [], [
            'available' => $coverAvailable,
        ]);

        $download = array_merge([
            'enabled' => false,
            'disk' => 'local',
            'path' => null,
            'filename' => $item['slug'].'.pdf',
            'label' => 'Download file',
            'size' => null,
        ], $item['download'] ?? []);

        $download['available'] = false;

        if ($download['enabled'] && is_string($download['path']) && $download['path'] !== '') {
            $download['available'] = Storage::disk($download['disk'])->exists($download['path']);

            if ($download['available'] && $download['size'] === null) {
                $download['size'] = self::formatBytes(Storage::disk($download['disk'])->size($download['path']));
            }
        }

        $item['download'] = $download;

        return $item;
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
