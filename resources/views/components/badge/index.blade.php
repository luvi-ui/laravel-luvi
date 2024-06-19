@props([
    'variant' => null,
])

@inject('badge', 'App\Services\BadgeCvaService')

<div {{ $attributes->twMerge($badge(['variant' => $variant])) }}>
    {{ $slot }}
</div>
