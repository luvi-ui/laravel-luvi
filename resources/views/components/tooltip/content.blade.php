@aware([
    'delayDuration' => 700,
])

@props([
    'align' => 'center',
    'side' => 'top',
    'sideOffset' => 4,
])
@php
    $alignment = $side . ['center' => '', 'end' => '-end', 'start' => '-start'][$align];
@endphp

<div
    x-tooltip:content
    x-transition:enter.delay.{{ $delayDuration }}
    x-anchor.{{ $alignment }}.offset.{{ $sideOffset }}="document.getElementById($id('alpine-tooltip'))"
    {{ $attributes->twMerge('z-50 overflow-hidden rounded-md bg-primary px-3 py-1.5 text-xs text-primary-foreground') }}
>
    {{ $slot }}
</div>
