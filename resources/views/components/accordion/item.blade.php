@props(['value'])

<div
    x-accordion:item
    class="border-b"
    x-data="{ item: '{{ $value }}' }"
    :data-state="__getDataState(item)"
>
    {{ $slot }}
</div>
