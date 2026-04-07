@props([
    'store' => [],
    'lang' => 'id',
])

<header class="border-b border-[#3a2b1f] bg-[linear-gradient(180deg,#1b1510_0%,#14110e_100%)] text-[#f6efe6]">
    <div class="mx-auto max-w-[1460px] px-4 pt-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#33261c] pb-4 text-[11px] uppercase tracking-[0.24em] text-[#b89f8e]">
            <div class="flex flex-wrap items-center gap-3">
                <span>Control room</span>
                <span class="h-1 w-1 rounded-full bg-[#f6b26b]"></span>
                <span>{{ $store['brand']['subtitle'] ?? 'Request intake and queue management.' }}</span>
            </div>

            <div class="inline-flex items-center rounded-full border border-[#4b3627] bg-[#1f1913] p-1">
                <a href="{{ request()->fullUrlWithQuery(['lang' => 'id']) }}" class="rounded-full px-3 py-1.5 text-xs font-semibold {{ $lang === 'id' ? 'bg-[#f6b26b] text-[#1a120b]' : 'text-[#bea18f]' }}">ID</a>
                <a href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}" class="rounded-full px-3 py-1.5 text-xs font-semibold {{ $lang === 'en' ? 'bg-[#f6b26b] text-[#1a120b]' : 'text-[#bea18f]' }}">EN</a>
            </div>
        </div>

        <div class="grid gap-6 py-6 xl:grid-cols-[1fr_auto_1fr] xl:items-center">
            <nav class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-[#b39b8a]">
                @foreach ($store['utility_nav'] as $item)
                    <a href="{{ $item['href'] }}" class="transition hover:text-[#f6efe6]">{{ $item['label'] }}</a>
                @endforeach
            </nav>

            <div class="text-center">
                <a href="{{ route('request', ['lang' => $lang]) }}" class="inline-block">
                    <div class="font-display text-4xl font-bold tracking-[-0.05em] text-[#f6efe6] sm:text-5xl">ABU-ABU REQUEST</div>
                    <div class="mt-2 font-mono text-[11px] uppercase tracking-[0.34em] text-[#c0a48f]">Control Room</div>
                </a>
            </div>

            <div class="justify-self-stretch xl:justify-self-end xl:w-full xl:max-w-[430px]">
                <div class="grid gap-3 sm:grid-cols-3">
                    @foreach ($store['status_strip'] as $item)
                        <div class="rounded-2xl border border-[#392b20] bg-[#18130f] px-4 py-4 text-right">
                            <div class="font-mono text-[10px] uppercase tracking-[0.22em] text-[#ae9686]">{{ $item['label'] }}</div>
                            <div class="mt-2 text-2xl font-semibold text-[#f6efe6]">{{ $item['value'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</header>
