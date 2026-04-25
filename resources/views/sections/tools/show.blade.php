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

    <main class="bg-[linear-gradient(180deg,#121512_0%,#0f120f_100%)] animate-[shift_120s_linear_infinite]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <a href="{{ route('tools.index', ['lang' => $lang]) }}" class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-[0.22em] text-[#c9ff4d] transition hover:text-[#e0ff90]">
                <span>&larr;</span>
                <span>Back to tools console</span>
            </a>

            <section class="mt-8 grid gap-8 xl:grid-cols-[260px_1fr_340px]">
                <aside class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#96a28b]">Package facts</div>
                    <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Reference rail</h2>

                    <div class="mt-6 space-y-4 text-sm text-[#aeb7a8]">
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Release status</div>
                            <div class="mt-2 text-[#eef2ea]">{{ $tool['release_status'] }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Access state</div>
                            <div class="mt-2 text-[#eef2ea]">{{ $tool['license_state'] }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Build type</div>
                            <div class="mt-2 text-[#eef2ea]">{{ $tool['build_type'] }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Vendor</div>
                            <div class="mt-2 text-[#eef2ea]">{{ $tool['vendor'] }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Version</div>
                            <div class="mt-2 text-[#eef2ea]">v{{ $tool['version'] }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">OS support</div>
                            <div class="mt-2 text-[#eef2ea]">{{ strtoupper(implode(', ', $tool['os'])) }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Checksum</div>
                            <div class="mt-2 text-[#eef2ea]">{{ $tool['checksum'] }}</div>
                        </div>
                        <div class="border-l border-[#33402d] pl-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#86927d]">Package size</div>
                            <div class="mt-2 text-[#eef2ea]">{{ $tool['download']['size'] ?? $tool['filesize'] }}</div>
                        </div>
                    </div>
                </aside>

                <section>
                    <div class="rounded-[1.8rem] border border-[#2c3528] bg-[linear-gradient(180deg,#171d16_0%,#141814_100%)] p-6">
                        <div class="flex flex-wrap items-center gap-3 font-mono text-[11px] uppercase tracking-[0.24em] text-[#8e9a84]">
                            <span>{{ strtoupper($tool['category']) }}</span>
                            <span class="h-1 w-1 rounded-full bg-[#c9ff4d]"></span>
                            <span>{{ strtoupper(implode(', ', $tool['os'])) }}</span>
                            <span class="h-1 w-1 rounded-full bg-[#c9ff4d]"></span>
                            <span>{{ \Illuminate\Support\Carbon::parse($tool['updated_at'])->format('M j, Y') }}</span>
                        </div>

                        <div class="mt-6 grid gap-6 lg:grid-cols-[140px_1fr]">
                            <div class="flex h-32 w-32 items-center justify-center rounded-[2rem] border border-white/10 bg-[#0f130f] font-mono text-3xl font-semibold text-white" style="box-shadow: inset 0 0 0 1px {{ $tool['accent'] }}55;">
                                {{ $tool['icon'] }}
                            </div>

                            <div>
                                <h1 class="text-4xl font-semibold leading-tight text-[#eef2ea] sm:text-5xl">{{ $tool['title'] }}</h1>
                                <p class="mt-4 max-w-3xl text-base leading-8 text-[#acb6a6]">{{ $tool['summary'] }}</p>

                                <div class="mt-6 flex flex-wrap gap-3">
                                    @if ($tool['download']['available'])
                                        <a href="{{ route('tools.download', ['slug' => $tool['slug'], 'lang' => $lang]) }}" class="inline-flex items-center rounded-2xl bg-[#c9ff4d] px-5 py-3 text-sm font-semibold text-[#11140f] transition hover:bg-[#d9ff6e]">
                                            {{ $tool['download']['label'] }}
                                        </a>
                                    @else
                                        <span class="inline-flex items-center rounded-2xl border border-[#364230] px-5 py-3 text-sm text-[#95a08b]">Archive not available yet</span>
                                    @endif
                                    <a href="{{ route('tools.help', ['slug' => 'installer-repair-checklist', 'lang' => $lang]) }}" class="inline-flex items-center rounded-2xl border border-[#3d4937] px-5 py-3 text-sm font-semibold text-[#e8ede4] transition hover:border-[#566751]">
                                        Open recovery guide
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-3">
                            <div class="rounded-2xl border border-[#2f392a] bg-[#111510] px-4 py-4">
                                <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Downloads</div>
                                <div class="mt-2 text-xl font-semibold text-[#eef2ea]">{{ $tool['download_count'] }}</div>
                            </div>
                            <div class="rounded-2xl border border-[#2f392a] bg-[#111510] px-4 py-4">
                                <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Integrity</div>
                                <div class="mt-2 text-xl font-semibold text-[#eef2ea]">{{ $tool['checksum'] }}</div>
                            </div>
                            <div class="rounded-2xl border border-[#2f392a] bg-[#111510] px-4 py-4">
                                <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#89957f]">Status</div>
                                <div class="mt-2 text-xl font-semibold {{ $tool['download']['available'] ? 'text-[#c9ff4d]' : 'text-[#929d89]' }}">
                                    {{ $tool['download']['available'] ? 'Ready' : 'Pending' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="mt-8 grid gap-8 xl:grid-cols-[1.05fr_0.95fr]">
                        <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Install notes</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Operational notes</h2>

                            <div class="mt-6 divide-y divide-[#263021] border-y border-[#263021]">
                                @foreach ($tool['notes'] as $note)
                                    <div class="py-4 text-sm leading-7 text-[#acb6a6]">{{ $note }}</div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                <div class="font-mono text-[11px] uppercase tracking-[0.28em] text-[#95a08a]">Changelog summary</div>
                                <p class="mt-3 text-sm leading-7 text-[#acb6a6]">{{ $tool['release_notes'] }}</p>
                            </div>
                        </div>

                        <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Dependencies</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Runtime checklist</h2>
                            <div class="mt-6 space-y-3">
                                @foreach ($tool['dependencies'] as $dependency)
                                    <div class="rounded-2xl border border-[#2f392a] bg-[#101410] px-4 py-4 text-sm text-[#e8ede4]">{{ $dependency }}</div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <section class="mt-8 grid gap-8 xl:grid-cols-[1fr_1fr]">
                        <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Archive notes</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Build profile</h2>
                            <div class="mt-6 divide-y divide-[#263021] border-y border-[#263021]">
                                @forelse ($tool['archive_notes'] as $note)
                                    <div class="py-4 text-sm leading-7 text-[#acb6a6]">{{ $note }}</div>
                                @empty
                                    <div class="py-4 text-sm leading-7 text-[#acb6a6]">This package keeps a straightforward archive structure with verified metadata and a simple handoff path.</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">System requirements</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Compatibility sheet</h2>
                            <div class="mt-6 grid gap-4">
                                <div class="rounded-2xl border border-[#2f392a] bg-[#101410] p-4">
                                    <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#8f9a85]">Minimum</div>
                                    <div class="mt-3 space-y-2 text-sm text-[#e8ede4]">
                                        @forelse ($tool['requirements']['minimum'] as $line)
                                            <div>{{ $line }}</div>
                                        @empty
                                            <div>Standard system requirements apply for this package type.</div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="rounded-2xl border border-[#2f392a] bg-[#101410] p-4">
                                    <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#8f9a85]">Recommended</div>
                                    <div class="mt-3 space-y-2 text-sm text-[#e8ede4]">
                                        @forelse ($tool['requirements']['recommended'] as $line)
                                            <div>{{ $line }}</div>
                                        @empty
                                            <div>Recommended profile information will appear here when provided.</div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    @if (count($tool['screenshots']) > 0)
                        <section class="mt-8 rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Media strip</div>
                            <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Screenshots</h2>
                            <div class="mt-6 grid gap-4 md:grid-cols-3">
                                @foreach ($tool['screenshots'] as $shot)
                                    <div class="overflow-hidden rounded-[1.4rem] border border-[#2e392a] bg-[linear-gradient(180deg,#223128_0%,#141814_100%)]">
                                        <div class="aspect-[4/3] bg-[radial-gradient(circle_at_top_left,rgba(201,255,77,0.14),transparent_30%),radial-gradient(circle_at_bottom_right,rgba(126,231,255,0.18),transparent_36%),#161b16]"></div>
                                        <div class="p-4">
                                            <div class="text-sm font-semibold text-[#eef2ea]">{{ $shot['title'] }}</div>
                                            <div class="mt-2 font-mono text-[10px] uppercase tracking-[0.22em] text-[#8f9a85]">{{ $shot['tone'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </section>

                <aside class="rounded-[1.8rem] border border-[#2c3528] bg-[#151914] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#95a08a]">Related tools</div>
                    <h2 class="mt-3 text-2xl font-semibold text-[#eef2ea]">Keep nearby</h2>

                    <div class="mt-6 space-y-4">
                        @foreach ($relatedTools as $relatedTool)
                            <x-tools.tool-card :tool="$relatedTool" compact />
                        @endforeach
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection
