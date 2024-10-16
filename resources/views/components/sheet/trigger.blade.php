@props([
    'as' => 'fragment',
])
<x-dynamic-component
    :component="$as"
    :$attributes
    x-on:click="open = ! open"
>
    {{ $slot }}
</x-dynamic-component>
