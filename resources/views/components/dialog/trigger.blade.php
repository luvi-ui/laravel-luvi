@props([
    'variant' => 'outline',
])

<x-button
    :$variant
    @click="dialogOpen = true"
>
    {{ $slot }}
</x-button>
