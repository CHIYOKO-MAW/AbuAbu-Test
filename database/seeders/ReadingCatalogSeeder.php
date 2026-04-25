<?php

namespace Database\Seeders;

use App\Models\ReadingItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ReadingCatalogSeeder extends Seeder
{
    public function run(): void
    {
        collect($this->data())
            ->each(fn (array $itemData) => $this->seedItem($itemData));
    }

    protected function data(): array
    {
        return [
            [
                'type' => 'journal',
                'slug' => 'quiet-systems-vol-12',
                'title' => 'Quiet Systems Vol. 12',
                'author' => 'Editorial Board',
                'year' => '2026',
                'topic' => 'Design Systems',
                'published_at' => '2026-04-12',
                'updated_at' => '2026-04-15',
                'summary' => 'Exploring the impact of silent interfaces in dense information environments.',
                'abstract' => 'This volume focuses on how minimalism can reduce cognitive load without sacrificing functional density.',
                'publisher' => 'Abu-Abu Editorial',
                'pages' => 124,
                'format' => 'B5 Paper',
                'cover' => [
                    'image' => 'https://images.unsplash.com/photo-1544476915-ed1370594142?q=80&w=800',
                    'alt' => 'Abstract architectural photo',
                    'palette' => ['#1a1a1a', '#e5e5e5', '#333333'],
                ],
                'download' => [
                    'enabled' => true,
                    'size' => '4.2MB',
                ],
            ],
            [
                'type' => 'ebook',
                'slug' => 'curating-the-void',
                'title' => 'Curating the Void',
                'author' => 'Chiyoko Maw',
                'year' => '2025',
                'topic' => 'Digital Archives',
                'published_at' => '2025-11-20',
                'summary' => 'A guide to preserving digital assets in an era of ephemeral platforms.',
                'abstract' => 'Maw provides a framework for selecting and maintaining digital artifacts for long-term accessibility.',
                'publisher' => 'Independent Press',
                'pages' => 210,
                'format' => 'Digital Only',
                'cover' => [
                    'image' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=800',
                    'alt' => 'Dark library interior',
                    'palette' => ['#0c0c0c', '#5a5a5a', '#1a1a1a'],
                ],
                'download' => [
                    'enabled' => true,
                    'size' => '12.8MB',
                ],
            ],
            [
                'type' => 'essay',
                'slug' => 'the-natural-archive',
                'title' => 'The Natural Archive',
                'author' => 'Editorial Team',
                'year' => '2026',
                'topic' => 'Research Methods',
                'published_at' => '2026-02-15',
                'summary' => 'How biological metaphors help us understand information storage.',
                'abstract' => 'An analysis of organic systems and their parallels in modern database architecture.',
                'publisher' => 'Abu-Abu Press',
                'pages' => 45,
                'format' => 'A5 Booklet',
                'cover' => [
                    'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=800',
                    'alt' => 'Nature landscape with mist',
                    'palette' => ['#2f4f4f', '#dcdcdc', '#696969'],
                ],
                'download' => [
                    'enabled' => false,
                ],
            ],
            [
                'type' => 'journal',
                'slug' => 'open-review-ledger-03',
                'title' => 'Open Review Ledger 03',
                'author' => 'Ledger Editorial',
                'year' => '2026',
                'topic' => 'Research Methods',
                'published_at' => '2026-03-01',
                'summary' => 'A structured ledger for tracking peer review cycles.',
                'abstract' => 'This ledger provides a framework for documenting the evolution of research papers through multiple review rounds.',
                'publisher' => 'Ledger Press',
                'pages' => 88,
                'format' => 'A4 Ledger',
                'cover' => [
                    'image' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?q=80&w=800',
                    'alt' => 'Ledger book on a desk',
                    'palette' => ['#333', '#eee', '#555'],
                ],
                'download' => [
                    'enabled' => true,
                    'size' => '2.1MB',
                ],
            ],
            [
                'type' => 'ebook',
                'slug' => 'field-guide-to-interface-writing',
                'title' => 'Field Guide to Interface Writing',
                'author' => 'Interface Design Group',
                'year' => '2025',
                'topic' => 'Design Systems',
                'published_at' => '2025-05-10',
                'summary' => 'A practical guide to microcopy and interface language.',
                'abstract' => 'Focused on the intersection of design and linguistics in digital products.',
                'publisher' => 'Design Press',
                'pages' => 150,
                'format' => 'Ebook',
                'cover' => [
                    'image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563eb4c?q=80&w=800',
                    'alt' => 'Interface writing guide cover',
                    'palette' => ['#f0f', '#0ff', '#000'],
                ],
                'download' => [
                    'enabled' => true,
                    'size' => '5.5MB',
                ],
            ],
        ];
    }

    protected function seedItem(array $itemData): void
    {
        $item = ReadingItem::query()->updateOrCreate(
            [
                'type' => $itemData['type'],
                'slug' => $itemData['slug'],
            ],
            [
                'title'          => $itemData['title'],
                'author'         => $itemData['author'] ?? null,
                'year'           => $itemData['year'] ?? null,
                'topic'          => $itemData['topic'] ?? null,
                'published_at'   => $itemData['published_at'] ?? null,
                'updated_at_date' => $itemData['updated_at'] ?? null,
                'summary'        => $itemData['summary'] ?? null,
                'abstract'       => $itemData['abstract'] ?? null,
                'publisher'      => $itemData['publisher'] ?? null,
                'pages'          => $itemData['pages'] ?? null,
                'format'         => $itemData['format'] ?? null,
                'cover_image'    => data_get($itemData, 'cover.image'),
                'cover_alt'      => data_get($itemData, 'cover.alt'),
                'cover_palette'  => data_get($itemData, 'cover_palette', data_get($itemData, 'cover.palette', [])),
            ],
        );

        $item->download()->updateOrCreate(
            ['reading_item_id' => $item->id],
            Arr::only(array_merge([
                'enabled'  => false,
                'disk'     => 'local',
                'path'     => 'reading/'.$itemData['slug'].'.pdf',
                'filename' => $itemData['slug'].'.pdf',
                'label'    => 'Download PDF',
                'size'     => null,
            ], $itemData['download'] ?? []), [
                'enabled',
                'disk',
                'path',
                'filename',
                'label',
                'size',
            ]),
        );
    }
}
