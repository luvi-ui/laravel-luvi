<div
    x-show="open"
    x-transition.opacity.duration.500ms
    @click="open = false"
    {{ $attributes->twMerge('fixed inset-0 z-50 bg-black/80') }}
>
    {{ $slot }}
</div>
