<x-button
    x-on:click="sheetOpen = false; $refs.__sheet.close()"
    {{ $attributes->twMerge('') }}
>
    {{ $slot }}
    <span class="sr-only">Close</span>
</x-button>
