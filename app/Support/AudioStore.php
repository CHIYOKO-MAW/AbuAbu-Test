<?php

namespace App\Support;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AudioStore
{
    public static function store(): array
    {
        return config('abuabu.site.audio_store', []);
    }

    public static function albums(): Collection
    {
        return collect(self::store()['albums'] ?? [])
            ->map(fn (array $album) => self::hydrateAlbum($album))
            ->values();
    }

    public static function filterAlbums(Collection $albums, string $query = '', string $genre = 'Featured', string $type = 'all', string $format = 'all'): Collection
    {
        $query = strtolower(trim($query));

        return $albums
            ->filter(function (array $album) use ($query, $genre, $type, $format) {
                $matchesQuery = $query === ''
                    || str_contains(strtolower(implode(' ', [$album['artist'], $album['title'], $album['genre']])), $query);
                $matchesGenre = $genre === 'Featured' || $album['genre'] === $genre;
                $matchesType = $type === 'all' || $album['type'] === $type;
                $matchesFormat = $format === 'all' || in_array($format, $album['formats'], true);

                return $matchesQuery && $matchesGenre && $matchesType && $matchesFormat;
            })
            ->values();
    }

    public static function findAlbum(string $artistSlug, string $albumSlug): ?array
    {
        return self::albums()->first(function (array $album) use ($artistSlug, $albumSlug) {
            return $album['artist_slug'] === $artistSlug && $album['slug'] === $albumSlug;
        });
    }

    public static function relatedAlbums(array $selectedAlbum, int $limit = 5): Collection
    {
        return self::albums()
            ->reject(fn (array $album) => $album['artist_slug'] === $selectedAlbum['artist_slug'] && $album['slug'] === $selectedAlbum['slug'])
            ->filter(fn (array $album) => $album['artist'] === $selectedAlbum['artist'] || $album['genre'] === $selectedAlbum['genre'] || $album['recommended'])
            ->take($limit)
            ->values();
    }

    /**
     * @throws FileNotFoundException
     */
    public static function downloadResponse(array $album): StreamedResponse
    {
        abort_unless($album['download']['available'] ?? false, Response::HTTP_NOT_FOUND);

        return Storage::disk($album['download']['disk'])->download(
            $album['download']['path'],
            $album['download']['filename'],
        );
    }

    public static function hydrateAlbum(array $album): array
    {
        $coverImage = data_get($album, 'cover.image');
        $coverAvailable = is_string($coverImage) && $coverImage !== '' && is_file(public_path($coverImage));

        $album['cover'] = array_merge([
            'palette' => ['#151b2b', '#445', '#9cf'],
            'accent' => '#ffffff',
            'image' => null,
            'alt' => $album['title'].' cover artwork',
        ], $album['cover'] ?? [], [
            'available' => $coverAvailable,
        ]);

        $download = array_merge([
            'enabled' => false,
            'disk' => 'local',
            'path' => null,
            'filename' => $album['slug'].'.zip',
            'label' => 'Download Album',
            'size' => null,
        ], $album['download'] ?? []);

        $download['available'] = false;

        if ($download['enabled'] && is_string($download['path']) && $download['path'] !== '') {
            $download['available'] = Storage::disk($download['disk'])->exists($download['path']);

            if ($download['available'] && $download['size'] === null) {
                $download['size'] = self::formatBytes(Storage::disk($download['disk'])->size($download['path']));
            }
        }

        $album['download'] = $download;

        return $album;
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
