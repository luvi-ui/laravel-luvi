<div
    x-data="{
        __open: false,
        __close(focusAfter) {
            if (!this.__open) return
            this.__open = false
            focusAfter && focusAfter.focus()
        }
    }"
    x-modelable="__open"
    x-id="['popover-trigger']"
    x-on:keydown.escape.window="__close($refs.trigger)"
    x-on:focusin.window="! $refs.popoverContent.contains($event.target) && __close()"
    {{ $attributes }}
>
    {{ $slot }}
</div>
