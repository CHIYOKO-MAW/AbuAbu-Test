@extends('layouts.request')

@section('title', $pageTitle ?? 'Abu-Abu Request')
@section('description', $pageDescription ?? config('abuabu.brand.description'))

@section('content')
    <x-request.store-header :store="$store" :lang="$lang" />

    <main class="bg-[linear-gradient(180deg,#14110e_0%,#110d0a_100%)]">
        <div class="mx-auto max-w-[1460px] px-4 pb-16 pt-8 sm:px-6 lg:px-8">
            <section id="queue" class="grid gap-8 xl:grid-cols-[1.1fr_0.9fr]">
                <div class="rounded-[1.9rem] border border-[#392b20] bg-[linear-gradient(180deg,#1a1410_0%,#15100c_100%)] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#bd9f88]">{{ $store['hero']['eyebrow'] }}</div>
                    <h1 class="mt-4 max-w-4xl text-4xl font-semibold leading-tight text-[#f6efe6] sm:text-5xl">
                        {{ $store['hero']['title'] }}
                    </h1>
                    <p class="mt-6 max-w-3xl text-base leading-8 text-[#ccb8aa]">{{ $store['hero']['copy'] }}</p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        @foreach ($store['lanes'] as $lane)
                            <article class="rounded-3xl border border-[#34271d] bg-[#120e0b] p-4">
                                <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#b59b8b]">Lane 0{{ $loop->iteration }}</div>
                                <div class="mt-3 text-lg font-semibold text-[#f6efe6]">{{ $lane['title'] }}</div>
                                <p class="mt-2 text-sm leading-7 text-[#c3afa0]">{{ $lane['copy'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <aside id="status" class="rounded-[1.9rem] border border-[#392b20] bg-[#17120e] p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#bda08a]">Queue status</div>
                            <h2 class="mt-3 text-3xl font-semibold text-[#f6efe6]">Control room</h2>
                        </div>
                        <div class="rounded-full border border-[#4a3728] bg-[#120e0b] px-4 py-2 text-xs font-semibold uppercase tracking-[0.22em] text-[#f6b26b]">
                            live
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        @foreach ($store['queue_states'] as $state)
                            <article class="rounded-3xl border border-[#35281e] bg-[#110d0a] p-4">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="text-lg font-semibold text-[#f6efe6]">{{ $state['title'] }}</div>
                                    <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#c6a38c]">{{ $state['meta'] }}</div>
                                </div>
                                <p class="mt-3 text-sm leading-7 text-[#c5b0a1]">{{ $state['copy'] }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-6 rounded-3xl border border-[#3a2c21] bg-[#120e0b] p-5">
                        <div class="font-mono text-[11px] uppercase tracking-[0.28em] text-[#bda08a]">Flow steps</div>
                        <div class="mt-4 space-y-4">
                            @foreach ($store['steps'] as $step)
                                <div class="flex gap-4">
                                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#f6b26b] font-mono text-xs font-semibold text-[#1b140d]">{{ $loop->iteration }}</div>
                                    <div>
                                        <div class="text-sm font-semibold text-[#f6efe6]">{{ $step['title'] }}</div>
                                        <div class="mt-1 text-sm leading-7 text-[#c8b3a4]">{{ $step['copy'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </section>

            <section class="mt-8 grid gap-8 xl:grid-cols-[0.92fr_1.08fr]">
                <aside id="rules" class="rounded-[1.9rem] border border-[#392b20] bg-[#17120e] p-6">
                    <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#bda08a]">Rules</div>
                    <h2 class="mt-3 text-3xl font-semibold text-[#f6efe6]">Queue rules</h2>

                    <div class="mt-6 space-y-4">
                        @foreach ($store['rules'] as $rule)
                            <div class="rounded-3xl border border-[#34271d] bg-[#110d0a] p-4 text-sm leading-7 text-[#c8b3a4]">
                                {{ $rule }}
                            </div>
                        @endforeach
                    </div>
                </aside>

                <section id="submit" class="rounded-[1.9rem] border border-[#392b20] bg-[linear-gradient(180deg,#1a1410_0%,#15100c_100%)] p-6">
                    <div class="flex flex-wrap items-end justify-between gap-4">
                        <div>
                            <div class="font-mono text-[11px] uppercase tracking-[0.3em] text-[#bda08a]">Submission shell</div>
                            <h2 class="mt-3 text-3xl font-semibold text-[#f6efe6]">Structured intake form</h2>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($store['priority_tabs'] as $priority)
                                <span class="rounded-full border border-[#4a3728] bg-[#120e0b] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-[#d8b59a]">
                                    {{ $priority }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 grid gap-5">
                        @foreach ($store['form_fields'] as $field)
                            <div class="rounded-3xl border border-[#34271d] bg-[#110d0a] p-4">
                                <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#b39b8a]">{{ $field['label'] }}</div>
                                <div class="mt-3 rounded-2xl border border-[#433224] bg-[#18120e] px-4 py-4 text-sm text-[#8f7b6c]">
                                    {{ $field['placeholder'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 grid gap-4 lg:grid-cols-[1fr_1fr]">
                        <div class="rounded-3xl border border-[#34271d] bg-[#110d0a] p-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#b39b8a]">Request types</div>
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach ($store['request_types'] as $type)
                                    <span class="rounded-full border border-[#463426] px-3 py-1 text-xs text-[#d2bcad]">{{ $type }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="rounded-3xl border border-[#34271d] bg-[#110d0a] p-4">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#b39b8a]">Queue handoff</div>
                            <div class="mt-4 space-y-3 text-sm text-[#d2bcad]">
                                <div>Draft saved to intake lane</div>
                                <div>Review notes attached before publish</div>
                                <div>Final item mapped to reading, audio, or tools</div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>
@endsection
