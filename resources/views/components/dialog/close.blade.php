@props([
    'variant' => 'outline',
])

<x-button
    :$variant
    @click="dialogOpen = false"
>
    Close
</x-button>
