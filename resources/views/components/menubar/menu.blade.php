<div x-data="{ menuOpen: false }">
    <div
        x-menubar:menu
        x-model="menuOpen"
        class="relative flex items-center"
    >
        {{ $slot }}
    </div>
</div>
