@extends('layouts.reading')

@section('title', $pageTitle ?? 'Abu-Abu Reading')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-reading.store-header
        :store="$store"
        :lang="$lang"
        current-query=""
        current-type="all"
        current-topic="All topics"
        current-sort="latest"
    />

    <main class="bg-[linear-gradient(180deg,#f7f2e8_0%,#f3ede2_100%)] animate-[shift_120s_linear_infinite]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <a href="{{ route('reading.index', ['lang' => $lang]) }}" class="inline-flex items-center gap-2 border-b border-[#2b2620] pb-1 text-sm font-semibold uppercase tracking-[0.22em] text-[#2b2620] transition hover:text-[#4f6559]">
                <span>&larr;</span>
                <span>Back to reading library</span>
            </a>

            <section class="mt-8 grid gap-8 xl:grid-cols-[240px_1fr_320px]">
                <aside class="border-b border-[#ddd1c1] pb-8 xl:border-b-0 xl:border-r xl:pb-0 xl:pr-8">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Document facts</div>
                    <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Reference panel</h2>

                    <div class="mt-6 space-y-5 text-sm text-[#6d6256]">
                        <div class="border-l border-[#d8ccbb] pl-4">
                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Type</div>
                            <div class="mt-2 text-[#2b2620]">{{ ucfirst($item['type']) }}</div>
                        </div>
                        <div class="border-l border-[#d8ccbb] pl-4">
                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Author</div>
                            <div class="mt-2 text-[#2b2620]">{{ $item['author'] }}</div>
                        </div>
                        <div class="border-l border-[#d8ccbb] pl-4">
                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Topic</div>
                            <div class="mt-2 text-[#2b2620]">{{ $item['topic'] }}</div>
                        </div>
                        <div class="border-l border-[#d8ccbb] pl-4">
                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Pages</div>
                            <div class="mt-2 text-[#2b2620]">{{ $item['pages'] }}</div>
                        </div>
                        <div class="border-l border-[#d8ccbb] pl-4">
                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Publisher</div>
                            <div class="mt-2 text-[#2b2620]">{{ $item['publisher'] }}</div>
                        </div>
                        <div class="border-l border-[#d8ccbb] pl-4">
                            <div class="text-[10px] uppercase tracking-[0.24em] text-[#948879]">Updated</div>
                            <div class="mt-2 text-[#2b2620]">{{ \Illuminate\Support\Carbon::parse($item['updated_at'])->format('F j, Y') }}</div>
                        </div>
                    </div>
                </aside>

                <section>
                    <div class="border-b border-[#ddd1c1] pb-8">
                        <div class="flex flex-wrap items-center gap-3 text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373]">
                            <span>{{ strtoupper($item['type']) }}</span>
                            <span class="h-1 w-1 rounded-full bg-[#b8aa95]"></span>
                            <span>{{ $item['topic'] }}</span>
                            <span class="h-1 w-1 rounded-full bg-[#b8aa95]"></span>
                            <span>{{ $item['year'] }}</span>
                        </div>

                        <h1 class="mt-5 max-w-4xl text-4xl font-semibold leading-tight text-[#2b2620] sm:text-[3.3rem]" style="font-family: 'Fraunces', Georgia, serif;">
                            {{ $item['title'] }}
                        </h1>
                        <div class="mt-4 text-xl text-[#5f5549]" style="font-family: 'Fraunces', Georgia, serif;">{{ $item['author'] }}</div>

                        <div class="mt-8 grid gap-6 lg:grid-cols-[320px_1fr]">
                            <div class="max-w-[320px]">
                                <x-reading.cover :item="$item" size="hero" />
                            </div>

                            <div>
                                <p class="text-lg leading-8 text-[#4c443a]">{{ $item['summary'] }}</p>
                                <div class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                                    <div>
                                        <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#948879]">Abstract</div>
                                        <p class="mt-3 text-base leading-8 text-[#6b6053]">{{ $item['abstract'] }}</p>
                                    </div>
                                    <div>
                                        <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#948879]">Access</div>
                                        <div class="mt-3 space-y-3 text-sm text-[#6d6256]">
                                            <div class="flex items-center justify-between gap-4 border-b border-[#e2d7c8] pb-3">
                                                <span>Format</span>
                                                <span class="text-[#2b2620]">{{ $item['format'] }}</span>
                                            </div>
                                            <div class="flex items-center justify-between gap-4 border-b border-[#e2d7c8] pb-3">
                                                <span>File size</span>
                                                <span class="text-[#2b2620]">{{ $item['download']['size'] ?? 'Waiting for upload' }}</span>
                                            </div>
                                            <div class="flex items-center justify-between gap-4 pb-1">
                                                <span>Status</span>
                                                <span class="{{ $item['download']['available'] ? 'text-[#4d6653]' : 'text-[#8c8173]' }}">
                                                    {{ $item['download']['available'] ? 'Ready to download' : 'Not available yet' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mt-5 flex flex-wrap gap-3">
                                            @if ($item['download']['available'])
                                                <a
                                                    href="{{ route('reading.download', ['type' => $item['type'], 'slug' => $item['slug'], 'lang' => $lang]) }}"
                                                    class="inline-flex items-center border-b border-[#2f4f4f] pb-1 text-sm font-semibold uppercase tracking-[0.24em] text-[#2f4f4f] transition hover:text-[#3c6464]"
                                                >
                                                    {{ $item['download']['label'] }}
                                                </a>
                                            @else
                                                <span class="text-sm uppercase tracking-[0.24em] text-[#8c8173]">Not available yet</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="mt-8 grid gap-8 xl:grid-cols-[1.1fr_0.9fr]">
                        <div>
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Preview</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Document preview</h2>

                            <div class="mt-6 border border-[#ddd1c1] bg-white p-8 shadow-[0_12px_24px_rgba(73,56,35,0.06)]">
                                <div class="mx-auto max-w-2xl">
                                    <div class="text-xs uppercase tracking-[0.32em] text-[#9b8f7f]">{{ strtoupper($item['type']) }} / {{ $item['year'] }}</div>
                                    <h3 class="mt-4 text-3xl font-semibold leading-tight text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">{{ $item['title'] }}</h3>
                                    <div class="mt-3 text-lg text-[#5e5448]">{{ $item['author'] }}</div>
                                    <div class="mt-8 h-px bg-[#eee4d7]"></div>
                                    <p class="mt-8 text-base leading-8 text-[#463f35]">{{ $item['abstract'] }}</p>
                                    <div class="mt-8 space-y-3">
                                        @foreach (range(1, 8) as $line)
                                            <div class="h-3 rounded-full bg-[#ede5d9] {{ $line === 8 ? 'w-2/3' : 'w-full' }}"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Reading profile</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Editorial notes</h2>

                            <div class="mt-6 divide-y divide-[#e2d7c8] border-y border-[#e2d7c8]">
                                <div class="py-4">
                                    <div class="text-[10px] uppercase tracking-[0.24em] text-[#9b8f7f]">Summary</div>
                                    <p class="mt-2 text-sm leading-7 text-[#6c6154]">{{ $item['summary'] }}</p>
                                </div>
                                <div class="py-4">
                                    <div class="text-[10px] uppercase tracking-[0.24em] text-[#9b8f7f]">Topic</div>
                                    <p class="mt-2 text-sm leading-7 text-[#6c6154]">{{ $item['topic'] }}</p>
                                </div>
                                <div class="py-4">
                                    <div class="text-[10px] uppercase tracking-[0.24em] text-[#9b8f7f]">Preview status</div>
                                    <p class="mt-2 text-sm leading-7 text-[#6c6154]">Reader view is still a placeholder so the page behaves like a calm document dossier before real PDF or EPUB rendering is added.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>

                <aside class="border-t border-[#ddd1c1] pt-8 xl:border-l xl:border-t-0 xl:pl-8 xl:pt-0">
                    <div class="text-[11px] font-semibold uppercase tracking-[0.3em] text-[#8f8373]">Related items</div>
                    <h2 class="mt-3 text-2xl font-semibold text-[#2b2620]" style="font-family: 'Fraunces', Georgia, serif;">Continue reading</h2>

                    <div class="mt-6 space-y-6">
                        @foreach ($relatedItems as $related)
                            <article class="border-b border-[#e2d7c8] pb-5 last:border-b-0">
                                <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-[#8f8373]">{{ strtoupper($related['type']) }}</div>
                                <a href="{{ route('reading.show', ['type' => $related['type'], 'slug' => $related['slug'], 'lang' => $lang]) }}" class="mt-2 block text-xl font-semibold leading-tight text-[#2b2620] transition hover:text-[#4f6559]" style="font-family: 'Fraunces', Georgia, serif;">
                                    {{ $related['title'] }}
                                </a>
                                <div class="mt-2 text-sm text-[#6d6256]">{{ $related['author'] }} / {{ $related['topic'] }}</div>
                                <p class="mt-3 text-sm leading-7 text-[#6d6256]">{{ $related['summary'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection
