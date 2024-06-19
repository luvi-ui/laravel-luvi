<div
    :id="$id('popover-trigger')"
    x-ref="popover-trigger"
    x-on:click="__open = !__open"
    :aria-expanded="__open"
    :aria-controls="$id('popover-trigger')"
    {{ $attributes->twMerge('inline-flex')}}
>
    {{ $slot }}
</div>
