@props([
    'eyebrow',
    'title',
    'lead',
    'primaryHref' => '#',
    'primaryLabel' => 'Browse',
    'secondaryHref' => '#',
    'secondaryLabel' => 'Request',
    'stats' => [],
])

<section class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">
    <div class="max-w-3xl">
        <p class="inline-flex rounded-full border border-white/10 bg-white/[0.04] px-4 py-2 text-xs font-semibold uppercase tracking-[0.28em] text-[#A0A3BD]">
            {{ $eyebrow }}
        </p>

        <h1 class="mt-6 font-display text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-7xl">
            {{ $title }}
        </h1>

        <p class="mt-6 max-w-2xl text-base leading-8 text-[#A0A3BD] sm:text-lg">
            {{ $lead }}
        </p>

        <div class="mt-8 flex flex-wrap gap-3">
            <x-button.primary href="{{ $primaryHref }}">{{ $primaryLabel }}</x-button.primary>
            <a
                href="{{ $secondaryHref }}"
                class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/[0.03] px-5 py-3 text-sm font-semibold text-[#EAEAF0] transition hover:border-white/20 hover:bg-white/[0.06]"
            >
                {{ $secondaryLabel }}
            </a>
        </div>

        @if (! empty($stats))
            <div class="mt-10 grid gap-4 sm:grid-cols-3">
                @foreach ($stats as $stat)
                    <div class="rounded-3xl border border-white/10 bg-white/[0.04] px-5 py-4">
                        <div class="font-display text-2xl font-bold text-white">{{ $stat['value'] }}</div>
                        <div class="mt-1 text-sm text-[#A0A3BD]">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div>
        {{ $slot }}
    </div>
</section>
