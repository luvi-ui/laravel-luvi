<div
    x-cloak
    x-show="__isOpen(item)"
    x-collapse
    {{ $attributes->twMerge('overflow-hidden text-sm') }}
>
    <div class="pb-4 pt-0">
        {{ $slot }}
    </div>
</div>
