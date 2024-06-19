<div
    x-data
    x-menubar
    tabindex="0"
    {{ $attributes->twMerge('inline-flex h-9 items-center space-x-1 rounded-md border bg-background p-1 shadow-sm') }}
>
    {{ $slot }}
</div>
