<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadHelper
{
    private const MAX_SIZES = [
        'cover' => 30 * 1024 * 1024,      // 30MB
        'doc' => 50 * 1024 * 1024,        // 50MB
        'audio' => 500 * 1024 * 1024,      // 500MB
    ];

    private const ALLOWED = [
        'cover' => ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif'],
        'doc' => ['pdf', 'epub', 'mobi'],
        'audio' => ['flac', 'wav', 'mp3', 'aac', 'm4a', 'ogg'],
    ];

    public static function handleCoverUpload(UploadedFile $file, string $type, string $slug): ?string
    {
        $extension = $file->getClientOriginalExtension();
        if (!in_array(strtolower($extension), self::ALLOWED['cover'])) {
            return null;
        }

        if ($file->getSize() > self::MAX_SIZES['cover']) {
            return null;
        }

        $directory = "uploads/covers/{$type}";
        $filename = "{$slug}.{$extension}";

        $path = $file->storeAs($directory, $filename, 'public');

        return $path;
    }

    public static function handleDocUpload(UploadedFile $file, string $type, string $slug): ?string
    {
        $extension = $file->getClientOriginalExtension();
        if (!in_array(strtolower($extension), self::ALLOWED['doc'])) {
            return null;
        }

        if ($file->getSize() > self::MAX_SIZES['doc']) {
            return null;
        }

        $directory = "uploads/documents/{$type}";
        $filename = "{$slug}.{$extension}";

        $path = $file->storeAs($directory, $filename, 'public');

        return $path;
    }

    public static function handleAudioUpload(UploadedFile $file, string $albumSlug, int $trackNumber = null): ?string
    {
        $extension = $file->getClientOriginalExtension();
        if (!in_array(strtolower($extension), self::ALLOWED['audio'])) {
            return null;
        }

        if ($file->getSize() > self::MAX_SIZES['audio']) {
            return null;
        }

        $directory = "uploads/audio/{$albumSlug}";
        $filename = $trackNumber 
            ? "track-{$trackNumber}.{$extension}" 
            : "album.{$extension}";

        $path = $file->storeAs($directory, $filename, 'public');

        return $path;
    }

    public static function deleteFile(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

    public static function getUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }

    public static function exists(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return true;
        }

        return Storage::disk('public')->exists($path);
    }
}