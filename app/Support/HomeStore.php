<?php

namespace App\Support;

class HomeStore
{
    public static function viewModel(string $lang): array
    {
        $site = config('abuabu.site', []);
        $home = $site['home'] ?? [];

        return [
            'brand' => config('abuabu.brand', []),
            'home' => $home,
            'navigation' => self::navigation($site['navigation'] ?? [], $lang),
            'doors' => self::doors($home['categories'] ?? [], $lang),
        ];
    }

    protected static function navigation(array $items, string $lang): array
    {
        return collect($items)
            ->map(fn (array $item) => array_merge($item, [
                'url' => self::localizedHref($item['href'] ?? '#', $lang),
            ]))
            ->all();
    }

    protected static function doors(array $categories, string $lang): array
    {
        return collect($categories)
            ->map(function (array $category, int $index) use ($lang) {
                $slug = $category['slug'] ?? 'audio';

                return array_merge($category, [
                    'url' => self::doorUrl($slug, $lang),
                    'note' => self::doorNotes()[$slug] ?? self::doorNotes()['audio'],
                    'wash' => self::doorWashes()[$slug] ?? self::doorWashes()['audio'],
                    'frame' => self::doorFrames()[$slug] ?? 'lg:col-span-6',
                    'number' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
                ]);
            })
            ->all();
    }

    protected static function localizedHref(string $href, string $lang): string
    {
        if ($href === '#' || str_starts_with($href, '#')) {
            return $href;
        }

        $separator = str_contains($href, '?') ? '&' : '?';

        return $href.$separator.'lang='.$lang;
    }

    protected static function doorUrl(string $slug, string $lang): string
    {
        return match ($slug) {
            'reading' => route('reading.index', ['lang' => $lang]),
            'audio' => route('audio.index', ['lang' => $lang]),
            'tools' => route('tools.index', ['lang' => $lang]),
            'request' => route('request', ['lang' => $lang]),
            default => '#',
        };
    }

    protected static function doorNotes(): array
    {
        return [
            'reading' => ['id' => 'cahaya paling tenang', 'en' => 'the calmest light'],
            'audio' => ['id' => 'gelombang paling aktif', 'en' => 'the liveliest signal'],
            'tools' => ['id' => 'ruang kerja paling padat', 'en' => 'the densest workspace'],
            'request' => ['id' => 'jalur yang belum punya rak', 'en' => 'the path without a shelf yet'],
        ];
    }

    protected static function doorWashes(): array
    {
        return [
            'reading' => 'from-[#d9cdb1]/18 via-[#d9cdb1]/8 to-transparent',
            'audio' => 'from-[#7d67ff]/18 via-[#7d67ff]/8 to-transparent',
            'tools' => 'from-[#4dcf85]/18 via-[#4dcf85]/8 to-transparent',
            'request' => 'from-[#f0ae73]/18 via-[#f0ae73]/8 to-transparent',
        ];
    }

    protected static function doorFrames(): array
    {
        return [
            'reading' => 'lg:col-span-7 lg:min-h-[29rem]',
            'audio' => 'lg:col-span-5 lg:min-h-[23rem] lg:translate-y-10',
            'tools' => 'lg:col-span-4 lg:min-h-[22rem]',
            'request' => 'lg:col-span-8 lg:min-h-[19rem] lg:-translate-y-6',
        ];
    }
}
