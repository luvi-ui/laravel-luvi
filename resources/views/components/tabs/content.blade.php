@props([
    'value' => '',
])

<div
    x-show="__selected === '{{ $value }}'"
    {{ $attributes->twMerge('mt-2') }}
>
    {{ $slot }}
</div>
