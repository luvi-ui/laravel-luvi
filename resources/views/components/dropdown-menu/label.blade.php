@props([
    'inset' => false,
])

<li {{ $attributes->twMerge(['px-2 py-1.5 text-sm font-semibold', 'pl-8' => $inset]) }}>
    {{ $slot }}
</li>
