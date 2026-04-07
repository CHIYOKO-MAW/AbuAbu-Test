@props(['href' => '#'])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center rounded-full bg-[#6C5CE7] px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-[#6C5CE7]/25 transition duration-200 hover:-translate-y-0.5 hover:bg-[#7B6CFF] hover:shadow-[#6C5CE7]/35',
    ]) }}
>
    {{ $slot }}
</a>
