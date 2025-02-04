<button data-sidebar="menu-action"
    class="absolute right-1 top-1.5 flex aspect-square w-5 items-center justify-center rounded-md p-0 text-sidebar-foreground outline-none transition-transform hover:bg-sidebar-accent hover:text-sidebar-accent-foreground after:absolute after:-inset-2 after:md:hidden peer-data-[size=sm]/menu-button:top-1 peer-data-[size=default]/menu-button:top-1.5 peer-data-[size=lg]/menu-button:top-2.5"
    x-sidebar:collapsible data-icon="hidden">
    {{ $slot }}
</button>