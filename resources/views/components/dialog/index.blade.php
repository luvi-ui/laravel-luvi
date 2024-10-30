<div
    x-data="{ __dialogOpen: false }"
    x-modelable="__dialogOpen"
    {{ $attributes->twMerge('') }}
>
    {{ $slot }}
</div>
