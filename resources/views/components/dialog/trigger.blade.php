@props([
    'as' => 'fragment',
])
<x-dynamic-component
    :component="$as"
    :$attributes
    x-on:click="$refs.__dialog.showModal();"
>
    {{ $slot }}
</x-dynamic-component>
