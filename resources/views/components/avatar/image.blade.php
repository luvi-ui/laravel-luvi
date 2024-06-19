<img
    x-show="__showImage"
    x-ref="image"
    x-cloak
    x-init="$el.addEventListener('error', () => __applyState());
    $el.addEventListener('load', () => __applyState());"
    {{ $attributes->twMerge('aspect-square h-full w-full') }}
/>

