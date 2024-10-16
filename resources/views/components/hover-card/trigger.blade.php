@props([
    'as' => 'fragment',
])
<x-dynamic-component
    :component="$as"
    :attributes="$attributes->twMerge('inline-flex')"
    x-hover-card:trigger
>
    {{ $slot }}
</x-dynamic-component>
