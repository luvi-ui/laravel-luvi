<div
    x-data="{ dialogOpen: false }"
    x-modelable="dialogOpen"
    {{ $attributes->twMerge('') }}
>
    {{ $slot }}
</div>
