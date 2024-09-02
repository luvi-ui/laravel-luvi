<x-button
    @click="open = false"
    {{ $attributes->twMerge('') }}
>
    {{ $slot }}
    <span class="sr-only">Close</span>
</x-button>
