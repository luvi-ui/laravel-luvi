<ul
    x-dropdown-menu:subitems
    x-transition:enter.origin.top.right
    x-anchor.right-start="document.getElementById($id('alpine-dropdown-menu'))"
    x-cloak
    {{ $attributes->twMerge('z-50 min-w-[8rem] rounded-md border bg-popover p-1 text-popover-foreground shadow-md') }}
>
    {{ $slot }}
</ul>
