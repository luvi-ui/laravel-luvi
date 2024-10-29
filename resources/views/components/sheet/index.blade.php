<div
    x-data="{ sheetOpen: false }"
    x-on:keydown.escape.window="sheetOpen = false"
>
    {{ $slot }}
</div>
