<span
    x-cloak
    x-show="__showFallback"
    {{ $attributes->twMerge('flex h-full w-full items-center justify-center rounded-full bg-muted') }}
>
    {{ $slot }}
</span>

