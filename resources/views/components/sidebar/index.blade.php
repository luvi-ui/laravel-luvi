<div class="group/sidebar-wrapper flex min-h-svh bg-sidebar">
    <div class="group peer hidden md:block text-sidebar-foreground">
        <div class="duration-200 relative h-svh w-[--sidebar-width] bg-transparent transition-[width] ease-linear"
            x-sidebar:collapsible data-offcanvas="!w-0" data-icon="!w-[--sidebar-width-icon]">
            <div class="duration-200 fixed inset-y-0 z-10 hidden h-svh w-[--sidebar-width] transition-[left,right,width] ease-linear md:flex left-0 border-r"
                x-sidebar:collapsible data-offcanvas="left-[calc(var(--sidebar-width)*-1)]" data-icon="!w-[--sidebar-width-icon]">
                <div class="flex h-full w-full flex-col bg-sidebar">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
