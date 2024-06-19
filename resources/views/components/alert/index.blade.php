@props([
    'variant' => null,
])

@inject('alert', 'App\Services\AlertCvaService')

<div {{ $attributes->twMerge($alert(['variant' => $variant])) }}>
    {{ $slot }}
</div>
