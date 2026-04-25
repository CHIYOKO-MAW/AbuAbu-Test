@extends('layouts.tools')

@section('title', $pageTitle ?? 'Abu-Abu Tools')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-tools.store-header
        :store="$store"
        :lang="$lang"
        current-query=""
        current-category="all"
        current-os="all"
        current-tag="all"
        current-sort="featured"
    />

    <main class="bg-[linear-gradient(180deg,#121512_0%,#0f120f_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <a href="{{ route('tools.index', ['lang' => $lang]) }}" class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-[0.22em] text-[#c9ff4d] transition hover:text-[#e0ff90]">
                <span>&larr;</span>
                <span>Back to tools console</span>
            </a>

            <section class="mt-8 grid gap-8 xl:grid-cols-[1fr_320px]">
                <article class="rounded-[1.8rem] border border-[#2c3528] bg-[linear-gradient(180deg,#171d16_0%,#141814_100%)] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#96a28b]">Activation & recovery note</div>
                    <h1 class="mt-4 max-w-4xl text-4xl font-semibold leading-tight text-[#eef2ea] sm:text-5xl">{{ $article['title'] }}</h1>
                    <div class="mt-4 text-sm uppercase tracking-[0.22em] text-[#a5af9a]">{{ $article['product'] }}</div>
                    <p class="mt-6 max-w-4xl text-base leading-8 text-[#acb6a6]">{{ $article['summary'] }}</p>

                    <section class="mt-8 grid gap-8 lg:grid-cols-[0.95fr_1.05fr]">
                        <div>
                            <div class="font-mono text-[11px] uppercase tracking-[0.28em] text-[#95a08a]">Symptoms</div>
                            <div class="mt-4 space-y-3">
                                @foreach ($article['symptoms'] as $symptom)
                                    <div class="rounded-2xl border border-[#2f392a] bg-[#101410] px-4 py-4 text-sm text-[#e8ede4]">{{ $symptom }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <div class="font-mono text-[11px] uppercase tracking-[0.28em] text-[#95a08a]">Recovery steps</div>
                            <div class="mt-4 divide-y divide-[#263021] rounded-[1.4rem] border border-[#2f392a] bg-[#101410]">
                                @foreach ($article['steps'] as $step)
                                    <div class="flex gap-4 px-5 py-5">
                                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#c9ff4d] font-mono text-xs font-semibold text-[#11140f]">{{ $loop->iteration }}</div>
                                        <p class="text-sm leading-7 text-[#e8ede4]">{{ $step }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </article>

                <aside class="space-y-6">
                    <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                        <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Related downloads</div>
                        <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Recommended tools</h2>
                        <div class="mt-6 space-y-4">
                            @foreach ($article['related_tools'] as $tool)
                                <x-tools.tool-card :tool="$tool" compact />
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                        <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">More help</div>
                        <div class="mt-4 space-y-4">
                            @foreach ($helpArticles as $relatedArticle)
                                <x-tools.help-card :article="$relatedArticle" :lang="$lang" />
                            @endforeach
                        </div>
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection
