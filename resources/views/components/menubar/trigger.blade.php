<div
    tabindex="-1"
    x-menubar:button
    role="menuitem"
    {{ $attributes->twMerge('flex cursor-default select-none items-center rounded-sm px-3 py-1 text-sm font-medium outline-none focus:bg-accent focus:text-accent-foreground data-[state=open]:bg-accent data-[state=open]:text-accent-foreground') }}
>
    {{ $slot }}
</div>
