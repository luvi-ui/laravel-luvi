@props([
    'as' => 'fragment',
])
<x-dynamic-component
    :component="$as"
    :attributes="$attributes->twMerge('inline-flex')"
    x-tooltip:trigger
>
    {{ $slot }}
</x-dynamic-component>
