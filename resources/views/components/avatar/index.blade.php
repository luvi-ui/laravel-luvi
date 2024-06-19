<span
    x-data="{
        __showFallback: false,
        __showImage: false,
        __applyState() {
            if (!$refs.image) {
                this.__showFallback = true;
                return
            }
            if (!$refs.image.complete) return

            this.__showFallback = $refs.image.naturalWidth === 0 || $refs.image.naturalHeight === 0
            this.__showImage = !this.__showFallback
        },
    }"
    x-init="$nextTick(() => __applyState())"
    {{ $attributes->twMerge('relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full') }}
>
    {{ $slot }}
</span>
