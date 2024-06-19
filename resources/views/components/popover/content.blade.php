@props([
    'align' => 'center',
    'side' => 'bottom',
    'sideOffset' => 4,
])
@php
    $alignment = $side . ['center' => '', 'end' => '-end', 'start' => '-start'][$align];
@endphp
<div
    :id="$id('popover-trigger')"
    x-ref="popoverContent"
    x-show="__open"
    x-trap="__open"
    x-anchor.{{ $alignment }}.offset.{{ $sideOffset }}="document.getElementById($id('popover-trigger'))"
    x-on:click.outside="__close($refs.trigger)"
    {{ $attributes->twMerge('z-50 p-4 overflow-hidden rounded-md border bg-popover text-popover-foreground shadow-md') }}
>
    {{ $slot }}
</div>
