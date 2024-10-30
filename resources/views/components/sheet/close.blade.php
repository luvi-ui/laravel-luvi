<x-button
    x-on:click="__sheetOpen = false"
    {{ $attributes->twMerge('') }}
>
    {{ $slot }}
    <span class="sr-only">Close</span>
</x-button>
