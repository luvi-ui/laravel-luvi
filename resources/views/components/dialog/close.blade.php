@props([
    'variant' => 'outline',
])

<x-button
    :$variant
    @click="$refs.__dialog.close()"
>
    Close
</x-button>
