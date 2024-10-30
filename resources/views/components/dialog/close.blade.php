@props([
    'variant' => 'outline',
])

<x-button
    :$variant
    x-on:click="__dialogOpen = false"
>
    @if ($slot->isEmpty())
        {{ __('Close') }}
    @else
        {{ $slot }}
    @endif
</x-button>
