@props([
    'name' => '',
    'defaultValue' => '',
])

<div
    x-data="{
        __selected: @if ($defaultValue) '{{ $defaultValue }}' @else 'undefined' @endif,
        name: '{{ $name }}',
    }"
    x-modelable="__selected"
    {{ $attributes->twMerge('grid gap-2') }}
>
    {{ $slot }}
</div>
