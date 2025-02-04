{{-- SIDEBAR PROVIDER NEEDS TO WRAP SIDEBAR AN MAIN CONTENT --}}
{{-- collapsible="" can be "offcanvas" / "icon" / "none" --}}
<x-sidebar.provider collapsible="icon">
    <x-sidebar>
        <x-sidebar.header>
            Sidebar Header
        </x-sidebar.header>

        <x-separator class="w-auto mx-2" />

        <x-sidebar.content>
            <x-sidebar.group>
                <x-sidebar.group-label>Group Label</x-sidebar.group-label>
                <x-sidebar.group-action>
                    <x-lucide-plus class="size-4" />
                </x-sidebar.group-action>
                <x-sidebar.group-content>
                    <x-sidebar.menu>
                        <x-sidebar.menu-item>
                            <x-sidebar.menu-button href="/">
                                <x-lucide-frame class="size-4" />
                                <span>Design Engineering</span>
                            </x-sidebar.menu-button>
                            <x-sidebar.menu-action>
                                <x-lucide-more-horizontal class="size-4" />
                            </x-sidebar.menu-action>
                        </x-sidebar.menu-item>
                        <x-sidebar.menu-item>
                            <x-sidebar.menu-button href="/">
                                <x-lucide-frame class="size-4" />
                                <span>Design Engineering</span>
                            </x-sidebar.menu-button>
                            <x-sidebar.menu-badge>
                                24
                            </x-sidebar.menu-badge>
                        </x-sidebar.menu-item>
                    </x-sidebar.menu>
                </x-sidebar.group-content>
            </x-sidebar.group>

            <x-separator class="w-auto mx-2" />

            <x-sidebar.group>
                <x-sidebar.group-content>
                    <x-sidebar.menu>
                        <x-sidebar.menu-item>
                            <x-sidebar.menu-button href="/">
                                <x-lucide-frame class="size-4" />
                                <span>Design Engineering</span>
                            </x-sidebar.menu-button>
                            <x-sidebar.menu-action>
                                <x-lucide-more-horizontal class="size-4" />
                            </x-sidebar.menu-action>
                        </x-sidebar.menu-item>
                        <x-sidebar.menu-item>
                            <x-sidebar.menu-button href="/">
                                <x-lucide-frame class="size-4" />
                                <span>Design Engineering</span>
                            </x-sidebar.menu-button>
                            <x-sidebar.menu-badge>
                                24
                            </x-sidebar.menu-badge>
                        </x-sidebar.menu-item>
                    </x-sidebar.menu>
                </x-sidebar.group-content>
            </x-sidebar.group>
        </x-sidebar.content>

        <x-separator class="w-auto mx-2" />

        <x-sidebar.footer>
            <div class="flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left outline-none">
                <x-avatar>
                    <x-avatar.image src="https://github.com/shadcn.png" />
                    <x-avatar.fallback>CN</x-avatar.fallback>
                </x-avatar>
                <div class="grid flex-1 text-left text-sm leading-tight">
                    <span class="truncate font-semibold">shadcn</span>
                    <span class="truncate text-xs">m@example.com</span>
                </div>
                <x-lucide-chevrons-up-down class="size-4" />
            </div>
        </x-sidebar.footer>
    </x-sidebar>


    {{-- MAIN CONTENT --}}

    <main class="p-4 grow">
        <x-sidebar.trigger>
            <x-button size="icon" variant="ghost">
                <x-lucide-panel-left class="size-5" />
            </x-button>
        </x-sidebar.trigger>
    </main>

</x-sidebar.provider>