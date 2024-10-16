@props([
    'as' => 'fragment',
])
<x-dynamic-component
    :component="$as"
    :$attributes
    x-dropdown-menu:button
>
    {{ $slot }}
</x-dynamic-component>
