@props([
    'variant' => null,
    'size' => null,
    'type' => 'button',
])

@inject('button', 'App\Services\ButtonCvaService')

<button
    type="{{ $type }}"
    {{ $attributes->twMerge($button(['variant' => $variant, 'size' => $size])) }}
>
    {{ $slot }}
</button>
