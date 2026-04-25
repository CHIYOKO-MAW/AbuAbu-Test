@extends('layouts.reading')

@section('title', $pageTitle ?? 'Abu-Abu Reading')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-reading.store-header
        :store="$store"
        :lang="$lang"
        :current-query="$currentQuery"
        :current-type="$currentType"
        :current-topic="$currentTopic"
        :current-sort="$currentSort"
    />

    <main class="bg-[linear-gradient(180deg,#f7f2e8_0%,#f3ede2_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <section class="grid gap-8 xl:grid-cols-[260px_1fr_360px]">
                <aside class="border-b border-[#ddd1c1] pb-8 xl:border-b-0 xl:border-r xl:pb-0 xl:pr-8">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Index</div>
                    <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Library guide</h2>

                    <div class="mt-6 space-y-5">
                        <div>
                            <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9b8f7f]">Navigation</div>
                            <div class="mt-3 space-y-2 text-sm text-[#5f5549]">
                                @foreach ($store['local_nav'] as $item)
                                    <a href="{{ $item['href'] }}" class="block transition hover:text-[#2b2620]">{{ $item['label'] }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9b8f7f]">Current view</div>
                            <div class="mt-3 space-y-3">
                                <div class="border-l-2 border-[#c8b89f] pl-4">
                                    <div class="text-sm font-semibold text-[#2b2620]">{{ $items->count() }} visible items</div>
                                    <p class="mt-1 text-sm leading-6 text-[#6e6255]">
                                        @if ($currentQuery !== '')
                                            Filtered by the current search query.
                                        @elseif ($currentTopic !== 'All topics')
                                            Focused on {{ $currentTopic }}.
                                        @elseif ($currentType !== 'all')
                                            Focused on {{ ucfirst($currentType) }} resources.
                                        @else
                                            Showing the full editorial shelf.
                                        @endif
                                    </p>
                                </div>
                                <div class="border-l-2 border-[#a0b09b] pl-4">
                                    <div class="text-sm font-semibold text-[#2b2620]">Warm-neutral reading mode</div>
                                    <p class="mt-1 text-sm leading-6 text-[#6e6255]">Built to feel like a library desk, not a storefront.</p>
                                </div>
                            </div>
                        </div>

                        <div id="topics">
                            <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#9b8f7f]">Topics</div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                @foreach (collect($store['topic_tabs'])->reject(fn ($topic) => $topic === 'All topics') as $topic)
                                    <a href="{{ route('reading.index', ['lang' => $lang, 'topic' => $topic]) }}" class="rounded-full border border-[#ddd1c1] px-3 py-1 text-xs text-[#685d51] transition hover:bg-white">
                                        {{ $topic }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>

                <section class="min-w-0">
                    @php($feature = $latestItems->first())

                    @if ($feature)
                        <article id="latest" class="border-b border-[#ddd1c1] pb-8">
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Latest feature</div>
                            <div class="mt-5 grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
                                <div class="max-w-[360px]">
                                    <x-reading.cover :item="$feature" />
                                </div>

                                <div class="min-w-0">
                                    <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373]">{{ strtoupper($feature['type']) }} / {{ $feature['topic'] }}</div>
                                    <h1 class="mt-4 text-4xl font-semibold leading-tight text-[#2b2620] sm:text-[3.2rem]" style="font-family: 'Fraunces', Georgia, serif;">
                                        {{ $feature['title'] }}
                                    </h1>
                                    <div class="mt-4 text-lg text-[#5f5549]">{{ $feature['author'] }}</div>
                                    <p class="mt-6 max-w-3xl text-base leading-8 text-[#665b4e]">{{ $feature['abstract'] }}</p>

                                    <div class="mt-8 flex flex-wrap gap-3">
                                        <a href="{{ route('reading.show', ['type' => $feature['type'], 'slug' => $feature['slug'], 'lang' => $lang]) }}" class="inline-flex items-center border-b border-[#2b2620] pb-1 text-sm font-semibold uppercase tracking-[0.24em] text-[#2b2620] transition hover:text-[#50615a]">
                                            Read dossier
                                        </a>
                                        @if ($feature['download']['available'])
                                            <a href="{{ route('reading.download', ['type' => $feature['type'], 'slug' => $feature['slug'], 'lang' => $lang]) }}" class="inline-flex items-center border-b border-[#5b7460] pb-1 text-sm font-semibold uppercase tracking-[0.24em] text-[#4d6653] transition hover:text-[#3f5645]">
                                                {{ $feature['download']['label'] }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                                        <div class="border-l border-[#ddd1c1] pl-4">
                                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Year</div>
                                            <div class="mt-2 text-sm font-semibold text-[#2b2620]">{{ $feature['year'] }}</div>
                                        </div>
                                        <div class="border-l border-[#ddd1c1] pl-4">
                                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Pages</div>
                                            <div class="mt-2 text-sm font-semibold text-[#2b2620]">{{ $feature['pages'] }}</div>
                                        </div>
                                        <div class="border-l border-[#ddd1c1] pl-4">
                                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Updated</div>
                                            <div class="mt-2 text-sm font-semibold text-[#2b2620]">{{ \Illuminate\Support\Carbon::parse($feature['updated_at'])->format('M j, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endif

                    <section class="mt-8 border-b border-[#ddd1c1] pb-8">
                        <div class="flex flex-wrap items-end justify-between gap-4">
                            <div>
                                <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">New & noteworthy</div>
                                <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">A reading-first index</h2>
                            </div>
                            <a href="#catalog" class="border-b border-[#2b2620] pb-1 text-xs font-semibold uppercase tracking-[0.24em] text-[#2b2620]">
                                Open full library
                            </a>
                        </div>

                        <div class="mt-6 divide-y divide-[#e2d7c8] border-y border-[#e2d7c8]">
                            @foreach ($latestItems as $item)
                                <article class="grid gap-4 py-5 md:grid-cols-[150px_1fr_180px] md:items-start">
                                    <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373]">
                                        {{ strtoupper($item['type']) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('reading.show', ['type' => $item['type'], 'slug' => $item['slug'], 'lang' => $lang]) }}" class="text-2xl font-semibold leading-tight text-[#2b2620] transition hover:text-[#4f6559]" style="font-family: 'Fraunces', Georgia, serif;">
                                            {{ $item['title'] }}
                                        </a>
                                        <div class="mt-2 text-sm text-[#6d6256]">{{ $item['author'] }} / {{ $item['topic'] }}</div>
                                        <p class="mt-3 text-sm leading-7 text-[#6d6256]">{{ $item['summary'] }}</p>
                                    </div>
                                    <div class="text-sm text-[#6d6256] md:text-right">
                                        <div>{{ \Illuminate\Support\Carbon::parse($item['published_at'])->format('M j, Y') }}</div>
                                        <div class="mt-2 uppercase tracking-[0.2em] text-[#938879]">{{ $item['pages'] }}</div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>

                    <section id="catalog" class="mt-8">
                        <div class="flex flex-wrap items-end justify-between gap-4">
                            <div>
                                <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Catalog</div>
                                <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Document index</h2>
                                <p class="mt-2 text-sm text-[#75695d]">
                                    @if ($currentQuery !== '')
                                        Results for "{{ $currentQuery }}"
                                    @elseif ($currentTopic !== 'All topics')
                                        Showing {{ $currentTopic }} items
                                    @elseif ($currentType !== 'all')
                                        Showing {{ ucfirst($currentType) }} items
                                    @else
                                        Browse the current reading selection
                                    @endif
                                </p>
                            </div>
                            <div class="text-sm text-[#6f6457]">{{ $items->count() }} items</div>
                        </div>

                        @if ($items->isEmpty())
                            <x-ui.empty-state
                                class="mt-8"
                                tone="paper"
                                title="No reading items matched"
                                copy="Try another title, author, topic, type, or sort order."
                            />
                        @else
                            <div class="mt-6 overflow-hidden border border-[#ddd1c1] bg-[#fbf7ef]">
                                <div class="hidden grid-cols-[140px_1.4fr_0.9fr_140px] gap-4 border-b border-[#ddd1c1] px-5 py-4 text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373] md:grid">
                                    <div>Type</div>
                                    <div>Title</div>
                                    <div>Topic / Author</div>
                                    <div class="text-right">Updated</div>
                                </div>

                                <div class="divide-y divide-[#e2d7c8]">
                                    @foreach ($items as $item)
                                        <article class="grid gap-4 px-5 py-5 md:grid-cols-[140px_1.4fr_0.9fr_140px] md:items-start">
                                            <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373]">{{ strtoupper($item['type']) }}</div>
                                            <div>
                                                <a href="{{ route('reading.show', ['type' => $item['type'], 'slug' => $item['slug'], 'lang' => $lang]) }}" class="text-xl font-semibold leading-tight text-[#2b2620] transition hover:text-[#4f6559]" style="font-family: 'Fraunces', Georgia, serif;">
                                                    {{ $item['title'] }}
                                                </a>
                                                <p class="mt-2 text-sm leading-7 text-[#6d6256]">{{ $item['summary'] }}</p>
                                            </div>
                                            <div class="text-sm text-[#6d6256]">
                                                <div>{{ $item['topic'] }}</div>
                                                <div class="mt-2 text-[#8b7f70]">{{ $item['author'] }}</div>
                                                <div class="mt-2 uppercase tracking-[0.2em] text-[#8b7f70]">{{ $item['format'] }} / {{ $item['pages'] }}</div>
                                            </div>
                                            <div class="text-sm text-[#6d6256] md:text-right">
                                                <div>{{ \Illuminate\Support\Carbon::parse($item['updated_at'])->format('M j, Y') }}</div>
                                                <div class="mt-2 {{ $item['download']['available'] ? 'text-[#4d6653]' : 'text-[#8c8173]' }}">
                                                    {{ $item['download']['available'] ? 'download ready' : 'preview only' }}
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </section>
                </section>

                <aside id="updated" class="border-t border-[#ddd1c1] pt-8 xl:border-l xl:border-t-0 xl:pl-8 xl:pt-0">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Recently updated</div>
                    <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Updated log</h2>

                    <div class="mt-6 space-y-6">
                        @foreach ($updatedItems as $item)
                            <article class="border-b border-[#e2d7c8] pb-5 last:border-b-0">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373]">{{ strtoupper($item['type']) }}</div>
                                        <a href="{{ route('reading.show', ['type' => $item['type'], 'slug' => $item['slug'], 'lang' => $lang]) }}" class="mt-2 block text-xl font-semibold leading-tight text-[#2b2620] transition hover:text-[#4f6559]" style="font-family: 'Fraunces', Georgia, serif;">
                                            {{ $item['title'] }}
                                        </a>
                                    </div>
                                    <div class="text-xs uppercase tracking-[0.2em] text-[#8f8373]">{{ \Illuminate\Support\Carbon::parse($item['updated_at'])->format('M j') }}</div>
                                </div>
                                <div class="mt-3 text-sm text-[#6d6256]">{{ $item['author'] }} / {{ $item['topic'] }}</div>
                                <p class="mt-3 text-sm leading-7 text-[#6d6256]">{{ $item['summary'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection
