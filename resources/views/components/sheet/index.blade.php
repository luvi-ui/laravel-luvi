<div
    x-data="{ __sheetOpen: false }"
    x-modelable="__sheetOpen"
    {{ $attributes->twMerge('') }}
>
    {{ $slot }}
</div>
