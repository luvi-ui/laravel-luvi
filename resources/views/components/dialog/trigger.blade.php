@props([
    'variant' => 'outline',
])

<x-button
    :$variant
    @click="$refs.__dialog.showModal();"
>
    {{ $slot }}
</x-button>
